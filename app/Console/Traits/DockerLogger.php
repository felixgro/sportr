<?php

namespace App\Console\Traits;

trait DockerLogger
{
    private $prefix = '<docker>';

    protected function dockerLog($msg)
    {
        $this->comment("{$this->prefix} {$msg}");
    }

    protected function dockerSuccess($msg)
    {
        $this->info("{$this->prefix} {$msg}");
    }

    protected function dockerError($msg)
    {
        $this->error("{$this->prefix} {$msg}");
    }
}
