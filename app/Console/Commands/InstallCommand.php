<?php

namespace App\Console\Commands;

use Facades\App\Services\RoleService;
use Illuminate\Console\Command;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\DB;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sportr:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepares Sportr to run properly on your system.';

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
        $this->info('>> Sportr Setup');
        $this->createEnv();
        $this->generateKey();

        $dbCreds = null;

        if ($this->confirm('Do you want to setup the .env interactively?', true)) {
            $dbCreds = $this->requestDatabaseCredentials();
            $this->updateEnv($dbCreds);
        } else {
            $this->warn('Make sure your the .env is configured correctly before migrating to your database.');
        }

        if ($this->confirm('Do you want to migrate the given database?', true)) {
            $this->migrateDatabase($dbCreds);
        }

        if ($this->databaseIsMigrated()) {
            $this->storeRoles();
        } else {
            return $this->error('Cannot store user Roles. Looks like your database is not migrated.');
        }

        $this->call('cache:clear');

        $this->info('Application ready! Have fun :)');
    }

    /**
     * Creates .env by copying .env.example
     *
     * @return void
     */
    protected function createEnv()
    {
        if (file_exists('.env'))
            return;

        copy('.env.example', '.env');
        $this->line('successfully created .env file.');
    }

    /**
     * Generates application key
     *
     * @return void
     */
    protected function generateKey()
    {
        if (strlen(config('app.key')) !== 0)
            return;

        $this->call('key:generate');
        $this->line('successfully created secret application key.');
    }

    /**
     * Request local database details from user.
     *
     * @return array
     */
    protected function requestDatabaseCredentials()
    {
        return [
            'DB_DATABASE' => $this->ask('Database name', 'sportr'),
            'DB_PORT' => $this->ask('Database port', 3307),
            'DB_USERNAME' => $this->ask('Database user', 'root'),
            'DB_PASSWORD' => $this->ask('Database password (leave blank for no password)'),
        ];
    }

    /**
     * Update the .env with given array
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
     * Creates all necessary database tables.
     *
     * @param array $updatedCreds
     * @return void
     */
    protected function migrateDatabase($updatedCreds = null)
    {
        if ($updatedCreds) {
            foreach ($updatedCreds as $key => $value) {
                $configKey = strtolower(str_replace('DB_', '', $key));

                if ($configKey === 'password' && $value == 'null') {
                    config(["database.connections.mysql.{$configKey}" => '']);

                    continue;
                }

                config(["database.connections.mysql.{$configKey}" => $value]);
            }
        }

        $this->call('migrate');
    }

    /**
     * Checks if database is migrated.
     *
     * @return bool
     */
    protected function databaseIsMigrated()
    {
        return DB::table('migrations')->where('migration', '2021_01_15_193742_create_roles_table')->exists();
    }

    /**
     * Save necessary Roles in the given database.
     *
     * @return void
     */
    protected function storeRoles()
    {
        if (RoleService::isSet())
            return;

        app(RoleSeeder::class)->run();
        $this->info('Roles stored in database!');
    }
}
