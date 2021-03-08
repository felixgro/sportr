<?php

namespace App\Console\Commands;

use App\Console\Traits\MysqlLogger;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class MakeDatabaseCommand extends Command
{
	use MysqlLogger;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'db:make {name?} {--no-test}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a MySQL database based on the database config file along with a *_test table for testing.';

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
		$schema = $this->argument('name') ?: config('database.connections.mysql.database');

		$db = (object) [
			'charset' => config('database.connections.mysql.charset', 'utf8mb4'),
			'collation' => config('database.connections.mysql.collation', 'utf8mb4_unicode_ci')
		];

		$this->mysqlLog("using charset '{$db->charset}'.");
		$this->mysqlLog("using collation '{$db->collation}'.");

		$this->createMainDatabase($schema, $db);

		if (!$this->option('no-test')) {
			$this->createTestingDatabase("{$schema}_test", $db);
		}

		return 0;
	}

	/**
	 * Creates database for main application.
	 *
	 * @param  string $schema
	 * @param  object $db
	 * @return void
	 */
	protected function createMainDatabase(string $schema, object $db)
	{
		config(['database.connections.mysql.database' => null]);

		try {
			if (count(DB::select('SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?', [$schema])) > 0) {
				$this->mysqlLog("found existing '{$schema}' database.");
			} else {
				$this->createDatabase($schema, $db);
			}
		} catch (QueryException $e) {
			if ($e->errorInfo[1] === 1049) {
				$this->createDatabase($schema, $db);
			}
		}

		config(['database.connections.mysql.database' => $schema]);
	}

	/**
	 * Creates database for testing.
	 *
	 * @param  string $schema
	 * @param  object $db
	 * @return void
	 */
	protected function createTestingDatabase(string $schema, object $db)
	{
		try {
			if (count(DB::select('SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?', [$schema])) > 0) {
				$this->mysqlLog("found existing '{$schema}' database.");
			} else {
				$this->createDatabase($schema, $db);
			}
		} catch (QueryException $e) {
			if ($e->errorInfo[1] === 1049) {
				$this->createDatabase($schema, $db);
			}
		}
	}

	/**
	 * Creates a database with given schema name and db settings object.
	 *
	 * @param  string $schema
	 * @param  object $db
	 * @return void
	 */
	private function createDatabase(string $schema, $db)
	{
		$this->mysqlLog("Creating '{$schema}'..");

		$charset = $db->charset;
		$collation = $db->collation;

		try {
			DB::statement("CREATE DATABASE IF NOT EXISTS $schema CHARACTER SET $charset COLLATE $collation;");

			$this->mysqlSuccess('done!');
		} catch (QueryException $e) {
			$this->mysqlError("Could not create database '${schema}'.");
		}
	}
}
