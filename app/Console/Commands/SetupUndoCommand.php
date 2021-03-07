<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Console\Traits\DatabaseEditor;
use App\Console\Traits\EnvEditor;

class SetupUndoCommand extends Command
{
	use EnvEditor;
	use DatabaseEditor;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'setup:undo';

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
		$this->info('>> Resetting Sportr to it`s initial state.');

		try {
			$this->resetDatabase();
		} catch (QueryException $e) {
			$this->printQueryException($e);
		}

		$this->resetStorage();
		$this->deleteEnv();

		$this->info('>> Sportr in initial state.');

		return 0;
	}

	/**
	 * Deletes all sport icons in public storage.
	 *
	 * @return void
	 */
	private function resetStorage()
	{
		exec('rm -rf public/storage');
		Storage::disk('public')->deleteDirectory('icons');
	}
}
