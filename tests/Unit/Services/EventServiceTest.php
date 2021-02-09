<?php

namespace Tests\Unit\Services;

use App\Models\Location;
use App\Models\Sport;
use App\Models\Team;
use App\Services\EventService;
use Tests\TestCase;

class EventServiceTest extends TestCase
{
	/** @test */
	public function event_service_can_create_non_existing_teams()
	{
		$sport = Sport::inRandomOrder()->first();

		$teamsArray = [
			[
				'team' => [
					'title' => 'Test Team 1'
				],
				'score' => null
			],
			[
				'team' => [
					'title' => 'Test Team 2'
				],
				'score' => null
			]
		];

		$returnVal = $this->callMethod(new EventService(), 'getTeamModels', [$sport, $teamsArray]);

		$this->assertInstanceOf('App\Models\Team', $returnVal->first());

		$this->assertDatabaseHas('teams', [
			'title' => 'Test Team 1',
			'sport_id' => $sport->id
		]);

		$this->assertDatabaseHas('teams', [
			'title' => 'Test Team 2',
			'sport_id' => $sport->id
		]);
	}

	/** @test */
	public function event_service_can_add_existing_team()
	{
		$sport = Sport::inRandomOrder()->first();
		$teams = Team::factory()->for($sport)->count(2)->create();

		$teamsArray = [
			[
				'id' => $teams[0]->id,
				'score' => 5
			],
			[
				'id' => $teams[1]->id,
				'score' => 2
			]
		];

		$returnVal = $this->callMethod(new EventService(), 'getTeamModels', [$sport, $teamsArray]);

		$this->assertInstanceOf('App\Models\Team', $returnVal->first());
		$this->assertCount(2, $returnVal);
	}

	/** @test */
	public function event_serice_can_create_non_existing_location()
	{
		$locationData = [
			'title' => 'Title here',
			'zip' => 12345,
			'address' => 'Street here',
			'city' => 'City here',
			'country' => 'Country here'
		];

		$returnVal = $this->callMethod(new EventService(), 'getLocationModel', [$locationData]);

		$this->assertInstanceOf('App\Models\Location', $returnVal);

		$this->assertDatabaseHas('locations', [
			'title' => 'Title here',
			'zip' => 12345,
			'address' => 'Street here',
			'city' => 'City here',
			'country' => 'Country here'
		]);
	}

	/** @test */
	public function event_service_can_add_existing_location()
	{
		$location = Location::factory()->create();

		$returnVal = $this->callMethod(new EventService(), 'getLocationModel', [$location->id]);

		$this->assertInstanceOf('App\Models\Location', $returnVal);
	}
}
