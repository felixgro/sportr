<?php

namespace Tests\Unit\Models;

use App\Models\{Event, Team};
use Tests\TestCase;

class SportTest extends TestCase
{
    /** @test */
    public function sport_has_many_teams()
    {
        $sport = Team::factory()->create()->sport;

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $sport->teams);
        $this->assertInstanceOf('App\Models\Team', $sport->teams->first());
    }

    /** @test */
    public function sport_has_many_events()
    {
        $sport = Event::factory()->create()->sport;

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $sport->events);
        $this->assertInstanceOf('App\Models\Event', $sport->events->first());
    }
}
