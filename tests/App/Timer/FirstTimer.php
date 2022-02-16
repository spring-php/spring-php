<?php
namespace App\Timer;

use SpringPHP\Core\Timer;
use SpringPHP\Inter\TimerInter;

class FirstTimer extends Timer implements TimerInter{
    public $ms = 3000;
    protected function before()
    {

    }

    protected function exec()
    {
        $memPercent = memory_get_usage(); //计算内存使用率
        echo date('Y-m-d H:i:s', time()) .' ' . $this->ms.'当前内存使用率：'.$memPercent."\n";
    }

    protected function after()
    {

    }

    protected function onException(\Throwable $throwable, $arg = null)
    {

    }

}
