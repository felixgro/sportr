<?php

namespace Tests\Unit\Models;

use App\Models\Sport;
use Tests\TestCase;

class SportTest extends TestCase
{
    /** @test */
    public function sport_has_many_teams()
    {
        $sport = Sport::factory()
            ->hasTeams(3)
            ->create();

        $this->assertCount(3, $sport->teams);
        $this->assertInstanceOf('App\Models\Team', $sport->teams->first());
    }

    /** @test */
    public function sport_has_many_events()
    {
        $sport = Sport::factory()
            ->hasEvents(3)
            ->create();

        $this->assertCount(3, $sport->events);
        $this->assertInstanceOf('App\Models\Event', $sport->events->first());
    }
}
