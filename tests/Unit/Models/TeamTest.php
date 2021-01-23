<?php

namespace Tests\Unit\Models;

use App\Models\Team;
use Tests\TestCase;

class TeamTest extends TestCase
{
    /** @test */
    public function team_belongs_to_sport()
    {
        $team = Team::factory()->create();

        $this->assertInstanceOf('App\Models\Sport', $team->sport);
    }

    /** @test */
    public function team_has_many_events()
    {
        $team = Team::factory()
            ->hasEvents(3)
            ->create();

        $this->assertInstanceOf('App\Models\Event', $team->events->first());
        $this->assertCount(3, $team->events);
    }
}
