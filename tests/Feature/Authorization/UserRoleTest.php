<?php

namespace Tests\Feature\Authorization;

use App\Models\{Event, Location, Sport, Team};
use Tests\TestCase;

class UserRoleTest extends TestCase
{
	/** @test */
	public function user_cannot_view_dashboard()
	{
		$this->signIn();

		$this->get(route('dashboard'))
			->assertForbidden();
	}

	/** @test */
	public function user_cannot_create_or_edit_sport()
	{
		$this->signIn();

		$sport = Sport::inRandomOrder()->first();

		$this->get(route('sports.create'))
			->assertForbidden();

		$this->post(route('sports.store'))
			->assertForbidden();

		$this->get(route('sports.edit', $sport))
			->assertForbidden();

		$this->put(route('sports.update', $sport), [])
			->assertForbidden();
	}

	/** @test */
	public function user_cannot_delete_sport()
	{
		$this->signIn();

		$sport = Sport::inRandomOrder()->first();

		$this->delete(route('sports.destroy', $sport))
			->assertForbidden();
	}

	/** @test */
	public function user_cannot_create_or_edit_event()
	{
		$this->signIn();

		$event = Event::factory()->create();

		$this->get(route('sportevents.create', $event->sport))
			->assertForbidden();

		$this->post(route('sportevents.store', $event->sport))
			->assertForbidden();

		$this->get(route('sportevents.edit', [$event->sport, $event]))
			->assertForbidden();

		$this->put(route('sportevents.update', [$event->sport, $event]), [])
			->assertForbidden();
	}

	/** @test */
	public function user_cannot_delete_event()
	{
		$this->signIn();

		$event = Event::factory()->create();

		$this->delete(route('sportevents.destroy', [$event->sport, $event]))
			->assertForbidden();
	}

	/** @test */
	public function user_cannot_create_or_edit_team()
	{
		$this->signIn();

		$team = Team::factory()->create();

		$this->get(route('sportteams.create', $team->sport))
			->assertForbidden();

		$this->post(route('sportteams.store', $team->sport))
			->assertForbidden();

		$this->get(route('sportteams.edit', [$team->sport, $team]))
			->assertForbidden();

		$this->put(route('sportteams.update', [$team->sport, $team]), [])
			->assertForbidden();
	}

	/** @test */
	public function user_cannot_delete_team()
	{
		$this->signIn();

		$team = Team::factory()->create();

		$this->delete(route('sportteams.destroy', [$team->sport, $team]))
			->assertForbidden();
	}

	/** @test */
	public function user_cannot_create_or_edit_location()
	{
		$this->signIn();

		$location = Location::factory()->create();

		$this->get(route('locations.create', $location))
			->assertForbidden();

		$this->post(route('locations.store', $location))
			->assertForbidden();

		$this->get(route('locations.edit', $location))
			->assertForbidden();

		$this->put(route('locations.update', $location), [])
			->assertForbidden();
	}

	/** @test */
	public function user_cannot_delete_location()
	{
		$this->signIn();

		$location = Location::factory()->create();

		$this->delete(route('locations.destroy', $location))
			->assertForbidden();
	}
}
