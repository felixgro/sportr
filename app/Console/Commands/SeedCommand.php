<?php

namespace App\Console\Commands;

use Database\Seeders\{EventSeeder};
use Illuminate\Console\Command;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sportr:seed {events=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the application with fake data.';

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
        $this->info('>> Seeding Sportr with fake data..');

        app(EventSeeder::class)->run($this->argument('events'));

        $this->info('>> Done');

        return 0;
    }
}
