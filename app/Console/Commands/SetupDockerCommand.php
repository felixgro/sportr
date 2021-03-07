<?php

namespace App\Console\Commands;

use App\Console\Traits\DatabaseEditor;
use App\Console\Traits\EnvEditor;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class SetupDockerCommand extends Command
{
	use EnvEditor;
	use DatabaseEditor;

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

		$mysql = [
			'DB_HOST' => 'mysql'
		];

		$this->updateEnv($mysql);

		exec('docker volume create sportr_sailmysql');
		exec('docker volume create sportr_sailredis');

		exec('vendor/bin/sail up --d');

		try {
			exec('vendor/bin/sail artisan db:make');
			sleep(10);
			ray(exec('vendor/bin/sail artisan migrate'));
			exec('vendor/bin/sail artisan db:seed');
		} catch (QueryException $e) {
			$this->printQueryException($e);
			return 1;
		}

		exec('vendor/bin/sail artisan cache:clear');

		try {
			exec('vendor/bin/sail artisan storage:link');
		} catch (\Exception $e) {
			$this->warn('>> Could not assign storage links.');
		}

		$this->info('>> Sportr is running on docker! Have fun :)');
		$this->comment('>> Container listening on `http://localhost:80`.');

		return 0;
	}
}
