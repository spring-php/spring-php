<?php

namespace SpringPHP\Core;

use SpringPHP\Component\Singleton;

class ManagerServer
{
    use Singleton;
    /**
     * @var array $serverConfig
     */
    protected $serverConfig;
    /**
     * @var \Swoole\Server $server
     */
    protected $server;


    /**
     * @return array
     */
    public function getServerConfig()
    {
        return $this->serverConfig;
    }


    public function setServerConfig($serverConfig): void
    {
        $this->serverConfig = $serverConfig;
    }


    /**
     * @return \Swoole\Server
     */
    public function getServer()
    {
        return $this->server;
    }


    public function setServer($server): void
    {
        $this->server = $server;
    }


}