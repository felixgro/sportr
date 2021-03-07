<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class MakeDatabaseCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'db:make {name?}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new MySQL database based on the database config file or the provided name.';

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
		$charset = config('database.connections.mysql.charset', 'utf8mb4');
		$collation = config('database.connections.mysql.collation', 'utf8mb4_unicode_ci');

		$this->info(">> Creating ${schema} database..");

		try {
			config(['database.connections.mysql.database' => null]);

			DB::statement("CREATE DATABASE IF NOT EXISTS $schema CHARACTER SET $charset COLLATE $collation;");

			config(['database.connections.mysql.database' => $schema]);

			$this->info('>> Done.');
			return 0;
		} catch (QueryException $e) {
			return $this->error("<mysql> Could not create ${schema} database.");
		}
	}
}
