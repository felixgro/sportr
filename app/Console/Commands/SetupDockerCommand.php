<?php

namespace App\Console\Commands;

use App\Console\Traits\DatabaseEditor;
use App\Console\Traits\DockerLogger;
use App\Console\Traits\EnvEditor;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class SetupDockerCommand extends Command
{
    use EnvEditor;
    use DatabaseEditor;
    use DockerLogger;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:docker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepares Sportr to run properly on docker.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('>> Setting up Sportr on docker..');
        $this->setupEnv();

        $this->updateEnv(['DB_HOST' => 'mysql']);

        $this->dockerLog('creating volumes..');
        exec('docker volume create sportr_sailmysql');
        exec('docker volume create sportr_sailredis');
        $this->dockerSuccess('done!');

        $this->dockerLog('building containers..');
        exec('vendor/bin/sail up --d');
        $this->dockerSuccess('done!');

        try {
            $this->dockerLog('creating databases..');
            exec('vendor/bin/sail artisan db:make');
            sleep(10);
            $this->dockerSuccess('done!');

            $this->dockerLog('migrating main database..');
            exec('vendor/bin/sail artisan migrate');
            $this->dockerSuccess('done!');

            $this->dockerLog('seeding main database with essential data..');
            exec('vendor/bin/sail artisan db:seed');
            $this->dockerSuccess('done!');
        } catch (QueryException $e) {
            $this->printQueryException($e);

            return 1;
        }

        exec('vendor/bin/sail artisan cache:clear');
        $this->dockerSuccess('application cache cleared!');

        try {
            exec('vendor/bin/sail artisan storage:link');
            $this->dockerSuccess('linked storage to public/ directory!');
        } catch (\Exception $e) {
            $this->warn('>> Could not link storage directory.');
        }

        $this->info('>> Sportr is running on docker! Have fun :)');
        $this->comment('>> Container listening on `http://localhost:80`.');

        return 0;
    }
}
