<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ResetCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'sportr:reset';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Rollback all database migrations, clear application storage and delete the .env file.';

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
		$this->info('>> Resetting Sportr');

		try {
			$this->resetDatabase();
		} catch (QueryException $e) {
			if ($e->errorInfo[1] === 2002) {
				$this->warn('<mysql> Could not find the specified database.');
			}
		}

		$this->resetStorage();
		$this->deleteEnv();

		$this->info('>> Sportr in initial state..');

		return 0;
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
	 * Deletes all sport icons in public storage.
	 *
	 * @return void
	 */
	protected function resetStorage()
	{
		exec('rm -rf public/storage');
		Storage::disk('public')->deleteDirectory('icons');
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
