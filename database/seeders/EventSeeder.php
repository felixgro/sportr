<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Sport;
use App\Models\Team;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Generate Events and assigns each event
     * two teams of the different sport.
     *
     * @param  int $amount
     * @return void
     */
    public function run(int $amount = 10)
    {
        // Limit max Amount to 50 to prevent duplicate entry for unique title key of teams
        $amount = $amount <= 50 ? $amount : 50;

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
