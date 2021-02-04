<?php

namespace Tests\Feature;

use App\Models\Location;
use Tests\TestCase;

class LocationTest extends TestCase
{

    private $role = 'admin';

    /** @test */
    public function location_list_can_be_requested_in_json_format()
    {
        Location::factory()->create();

        $this->get(route('locations.index'))
            ->assertJsonStructure()
            ->assertStatus(200);
    }

    /** @test */
    public function create_location_view_can_be_rendered()
    {
        $this->get(route('locations.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function edit_location_view_can_be_rendered()
    {
        $location = Location::factory()->create();

        $this->get(route('locations.edit', $location))
            ->assertStatus(200);
    }

    /** @test */
    public function location_can_be_created()
    {
        $this->signIn($this->role);

        $location = [
            'title' => 'Ernst-Happel-Stadion',
            'address' => 'Meiereistraße 7',
            'zip' => '1020',
            'city' => 'Vienna',
            'country' => 'Austria'
        ];

        $this->post(route('locations.store'), $location)
            ->assertRedirect();

        $this->assertDatabaseHas('locations', $location);
    }

    /** @test */
    public function location_can_be_updated()
    {
        $this->signIn($this->role);

        $location = Location::factory()->create();

        $this->put(route('locations.update', $location), [
            'title' => 'updated Title'
        ])->assertRedirect();

        $this->assertDatabaseHas('locations', [
            'title' => 'updated Title'
        ]);
    }

    /** @test */
    public function location_can_be_deleted()
    {
        $this->signIn($this->role);

        $location = Location::factory()->create();

        $this->delete(route('locations.destroy', $location))
            ->assertRedirect();

        $this->assertDatabaseMissing('locations', $location->only('id', 'title'));
    }
}
