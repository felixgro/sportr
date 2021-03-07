<?php

namespace App\Console\Traits;

trait EnvEditor
{
    /**
     * Copies env.example to .env and
     * generates an application key.
     *
     * @return void
     */
    protected function setupEnv()
    {
        $this->copyEnv();
        $this->generateAppKey();
    }

    /**
     * Creates .env by copying .env.example.
     *
     * @return bool
     */
    protected function copyEnv()
    {
        if (! file_exists('.env') && copy('.env.example', '.env')) {
            $this->comment('>> Copied .env.example to .env');

            return true;
        }

        $this->comment('>> .env file already exists.');

        return false;
    }

    /**
     * Generates an uique application key.
     *
     * @return void
     */
    protected function generateAppKey()
    {
        if (strlen(config('app.key')) === 0) {
            $this->callSilently('key:generate');
            $this->comment('>> Generated fresh application key.');

            return true;
        }

        $this->comment('>> Application key already defined.');

        return false;
    }

    /**
     * Update the .env with given array of key value pairs.
     *
     * @param array $data
     * @return void
     */
    protected function updateEnv($data)
    {
        $path = $this->laravel->environmentFilePath();

        foreach ($data as $key => $value) {
            file_put_contents($path, preg_replace(
                "/{$key}=(.*)/",
                "{$key}={$value}",
                file_get_contents($path)
            ));
        }
    }

    /**
     * Deletes .env file.
     *
     * @return void
     */
    protected function deleteEnv()
    {
        if (file_exists('.env')) {
            unlink('.env');
        }
    }
}
