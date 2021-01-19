<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\RoleSeeder;

class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sportr:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepares Sportr to run properly on your system with your MySQL Database.';

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
        $this->info('>> Interactive Sportr Setup');
        $this->createEnv();
        $this->generateKey();

        $dbCreds = null;

        if ($this->confirm('Do you want to setup the .env interactively?', true)) {
            $dbCreds = $this->requestDatabaseCredentials();
            $this->updateEnv($dbCreds);
        } else {
            $this->warn('Make sure the database in your .env file is configured correctly before migrating.');
        }

        if ($this->confirm('Do you want to migrate the given database?', true)) {
            $this->migrateDatabase($dbCreds);
        }

        if ($this->databaseIsMigrated()) {
            $this->storeRoles();
        } else {
            return $this->error('Your database needs to be migrated for the next steps.');
        }

        $this->call('cache:clear');

        $this->info('Sportr is ready! Have fun :)');
    }

    /**
     * Creates .env by copying .env.example.
     *
     * @return void
     */
    protected function createEnv()
    {
        if (file_exists('.env')) {
            return;
        }

        copy('.env.example', '.env');
        $this->info('.env created successfully.');
    }

    /**
     * Generates application key.
     *
     * @return void
     */
    protected function generateKey()
    {
        if (strlen(config('app.key')) !== 0) {
            return;
        }

        $this->call('key:generate');
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
            'DB_PORT' => $this->ask('Database port', 3306),
            'DB_USERNAME' => $this->ask('Database user', 'root'),
            'DB_PASSWORD' => $this->ask('Database password (leave blank for no password)'),
        ];
    }

    /**
     * Update the .env with given array.
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
        return \DB::table('migrations')->where('migration', '2020_01_15_193742_create_roles_table')->exists();
    }

    /**
     * Save necessary Roles in the given database.
     *
     * @return void
     */
    protected function storeRoles()
    {
        if (app(RoleSeeder::class)->run()) {
            $this->info('Roles stored successfully!');
        }
    }
}
