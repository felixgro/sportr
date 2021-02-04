<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Sport;
use App\Models\Team;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(int $amount = 10)
    {
        while ($amount > 0) {
            $sport = Sport::inRandomOrder()->first();

            // 50:50
            $hasScored = rand(0, 2) % 2 == 0;

            Event::factory()->for($sport)->hasAttached(
                Team::factory()->count(2)->for($sport),
                ['score' => $hasScored ? rand(0, 5) : null]
            )->create();

            $amount--;
        }
    }
}
