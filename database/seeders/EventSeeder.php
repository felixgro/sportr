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
            // 50:50
            $hasScored = rand(0, 2) % 2 == 0;

            $event = Event::factory()->create();

            $teams = Team::factory()->for($event->sport)->count(2)->create();

            $event->teams()->attach([
                $teams[0]->id => ['score' => $hasScored ? rand(0, 5) : null],
                $teams[1]->id => ['score' => $hasScored ? rand(0, 5) : null],
            ]);

            $amount--;
        }
    }
}
