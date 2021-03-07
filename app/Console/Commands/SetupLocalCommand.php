<?php

namespace App\Console\Commands;

use App\Console\Traits\DatabaseEditor;
use App\Console\Traits\EnvEditor;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class SetupLocalCommand extends Command
{
	use EnvEditor;
	use DatabaseEditor;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'setup:local';

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
		$this->info('>> Setting up Sportr locally..');
		$this->setupEnv();

		if ($this->confirm('>> Would you like to setup the .env interactively?', true)) {
			$this->updateEnv($updatedEnv = $this->requestDatabaseCredentials());
		} else {
			$this->warn('<warn> Make sure your .env file is configured correctly before proceeding.');
			if (!$this->confirm('>> Ready to migrate the specified database ?', true)) {
				$this->error('<abort> Rerun `php artisan setup:local` when your database is prepared.');
				return 1;
			}
		}

		try {
			$this->migrateDatabase($updatedEnv ?? null);
			$this->seedDatabase();
		} catch (QueryException $e) {
			$this->printQueryException($e);
			return 1;
		}

		$this->callSilently('cache:clear');
		$this->callSilently('storage:link');

		$this->info('>> Sportr is ready! Have fun :)');
		$this->comment('>> Run `php artisan serve` to start a development server.');

		return 0;
	}
}
