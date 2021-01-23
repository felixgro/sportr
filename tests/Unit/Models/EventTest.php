<?php

namespace Tests\Unit\Models;

use App\Models\Event;
use Tests\TestCase;

class EventTest extends TestCase
{
    /** @test */
    public function event_belongs_to_sport()
    {
        $event = Event::factory()->create();

        $this->assertInstanceOf('App\Models\Sport', $event->sport);
    }

    /** @test */
    public function event_belongs_to_location()
    {
        $event = Event::factory()->create();

        $this->assertInstanceOf('App\Models\Location', $event->location);
    }

    /** @test */
    public function event_has_many_teams()
    {
        $event = Event::factory()
            ->hasTeams(3)
            ->create();

        $this->assertInstanceOf('App\Models\Team', $event->teams->first());
        $this->assertCount(3, $event->teams);
    }
}
