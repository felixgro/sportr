<?php

namespace Tests\Unit\Models;

use App\Models\Location;
use Tests\TestCase;

class LocationTest extends TestCase
{
    /** @test */
    public function location_has_many_events()
    {
        $location = Location::factory()
            ->hasEvents(3)
            ->create();

        $this->assertInstanceOf('App\Models\Event', $location->events->first());
        $this->assertCount(3, $location->events);
    }
}
