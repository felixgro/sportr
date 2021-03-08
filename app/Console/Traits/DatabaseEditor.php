<?php

namespace App\Console\Traits;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait DatabaseEditor
{
	/**
	 * Request local database details from user.
	 *
	 * @return array
	 */
	protected function requestDatabaseCredentials()
	{
		return [
			'DB_HOST' => $this->ask('Database host', '127.0.0.1'),
			'DB_DATABASE' => $this->ask('Database name', 'sportr'),
			'DB_PORT' => $this->ask('Database port', 3306),
			'DB_USERNAME' => $this->ask('Database user', 'root'),
			'DB_PASSWORD' => $this->ask('Database password (leave blank for no password)'),
		];
	}

	/**
	 * Creates all necessary database tables.
	 *
	 * @param  array $updatedCreds
	 * @param  bool $docker
	 * @return void
	 */
	protected function migrateDatabase(array $updatedCreds = null, bool $docker = false)
	{
		if ($updatedCreds) {
			$this->updateMysqlConfig($updatedCreds);
		}

		if ($docker) {
			return exec('vendor/bin/sail artisan migrate');
		}

		$this->call('migrate');
	}

	/**
	 * Update current Mysql configuration.
	 *
	 * @param  array $updatedConfig
	 * @return void
	 */
	protected function updateMysqlConfig(array $updatedConfig)
	{
		foreach ($updatedConfig as $key => $value) {
			$configKey = strtolower(str_replace('DB_', '', $key));

			if ($configKey === 'password' && $value == 'null') {
				config(["database.connections.mysql.{$configKey}" => '']);

				continue;
			}

			config(["database.connections.mysql.{$configKey}" => $value]);
		}
	}

	/**
	 * Seed database with essential data.
	 *
	 * @param  bool $docker
	 * @return void
	 */
	protected function seedDatabase($docker = false)
	{
		if ($docker) {
			exec('vendor/bin/sail artisan db:seed');
		} else {
			$this->call('db:seed');
		}
	}

	/**
	 * Checks if database is migrated.
	 *
	 * @return bool
	 */
	protected function databaseIsMigrated()
	{
		return DB::table('migrations')->where('migration', '2020_01_15_193742_create_roles_table')->exists();
	}

	/**
	 * Drops all existing database tables.
	 *
	 * @return void
	 */
	protected function resetDatabase()
	{
		$this->call('migrate:reset');
		Schema::dropIfExists('migrations');
	}

	/**
	 * Converts QueryException to clean & human-readable
	 * error log message in console.
	 *
	 * @param  \Illuminate\Database\QueryException
	 * @return void
	 */
	protected function printQueryException(QueryException $e)
	{
		ray($e)->color('red');

		switch ($e->errorInfo[1]) {
		   case 2002: return $this->error('<mysql> Could not connect to the database.');
		   case 1046: return $this->error('<mysql> Cound not find the specified database.');
		   default: return $this->error('<mysql> An undefined database error occured.');
	   }
	}
}
