<?php

namespace SpringPHP\Template;


class RenderTcpWorker
{
    /**
     * @var RenderTcpWorker
     */
    public static $master_worker;  //主进程
    public static $master_socket;  //监听的socket端口套节字 resource

    /**
     * 所有socket套接字数组
     * @var array
     */
    public static $allSockets = [];


    public function __construct($ip = "0.0.0.0", $port = 65501)
    {
        set_time_limit(0);
        $this->ip = $ip;
        $this->port = $port;

        echo "\nServer init sucess\n";
    }


    /**
     * [读取get或post请求中的url，返回相应的文件]
     * @param  [string]
     * @return [string]
     * http头
     * method url protocols
     */
    public function request($string)
    {
        $tpl = unserialize($string);
        $smarty = new  Smarty();
        return $smarty->render($tpl['template'], $tpl['data'], $tpl['options']);
    }


    /**
     * 运行多进程模式
     */
    public function run()
    {
        @cli_set_process_title('spring-php RenderWorker master process pid=' . posix_getpid());
        self::$master_worker = $this;
        self::$master_socket = stream_socket_server("tcp://" . $this->ip . ":" . $this->port, $errno, $errstr);
        if (!self::$master_socket) {
            echo "$errstr ($errno)<br />\n";
        }
        stream_set_blocking(self::$master_socket, 0); //设置为非阻塞
        self::$allSockets[(int)self::$master_socket] = self::$master_socket;
        $this->forkOneWorker();

    }

    public function closeSocket($socket)
    {
        echo 'exit one socket ' . (int)$socket . "\r\n";
        unset(self::$allSockets[(int)$socket]);
        fclose($socket);
    }

    public function forkOneWorker()
    {

        @cli_set_process_title('spring-php RenderWorker worker pid=' . posix_getpid() . ' listen:' . $this->ip . ":" . $this->port);
        while (1) {
            $write = $except = null;
            $read = self::$allSockets;
            echo 'blocking pid=' . posix_getpid() . "\r\n";
            stream_select($read, $write, $except, NULL);  //阻塞在这边，这边不判断可写的情况
            foreach ($read as $index => $socket) {
                if ($socket === self::$master_socket) {
                    $new_socket = stream_socket_accept($socket);  //接收的新连接被别的进程处理了
                    if (empty($new_socket)) {
                        continue;
                    }
                    self::$allSockets[(int)$new_socket] = $new_socket;
                } else {
                    $string = fread($socket, 20480);
                    if ($string === '' || $string === false) {  //客户端已经退出了
                        $this->closeSocket($socket);
                        continue;
                    }
                    $data = $this->request($string);
                    $num = fwrite($socket, $data);
                    if ($num == 0) {
                        echo "WRITE ERROR:" . "\n";
                    } else {
                        echo "request already succeed\n";
                    }
                    $this->closeSocket($socket);
                }
            }
        }

    }

    public static function start($ip = "0.0.0.0", $port = 65501)
    {
        $server = new static($ip, $port);
        $server->run();
    }
}