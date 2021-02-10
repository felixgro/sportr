<?php

namespace Tests\Unit\Models;

use App\Models\Event;
use App\Models\Team;
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

    /** @test */
    public function event_has_scored_scope()
    {
        // delete all present events
        foreach (Event::all() as $event) {
            $event->delete();
        }

        // 3 scored events
        Event::factory()->count(3)->hasAttached(
            Team::factory()->count(2),
            ['score' => rand(0, 5)]
        )->create();

        // 1 unscored event
        Event::factory()->hasAttached(
            Team::factory()->count(2),
            ['score' => null]
        )->create();

        $this->assertCount(3, Event::scored()->get());
    }

    /** @test */
    public function event_has_upcomming_scope()
    {
        // delete all present events
        foreach (Event::all() as $event) {
            $event->delete();
        }

        // 3 scored events
        Event::factory()->count(3)->hasAttached(
            Team::factory()->count(2),
            ['score' => rand(0, 5)]
        )->create();

        // 1 unscored event
        Event::factory()->hasAttached(
            Team::factory()->count(2),
            ['score' => null]
        )->create();

        $this->assertCount(1, Event::upcomming()->get());
    }
}
