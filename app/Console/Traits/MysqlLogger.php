<?php

namespace App\Console\Traits;

trait MysqlLogger
{
    private $prefix = '<mysql>';

    protected function mysqlLog($msg)
    {
        $this->comment("{$this->prefix} {$msg}");
    }

    protected function mysqlSuccess($msg)
    {
        $this->info("{$this->prefix} {$msg}");
    }

    protected function mysqlError($msg)
    {
        $this->error("{$this->prefix} {$msg}");
    }
}
