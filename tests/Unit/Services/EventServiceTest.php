<?php

namespace Tests\Unit\Services;

use App\Models\Sport;
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

		$res = $this->callMethod(new EventService(), 'getTeamModels', [$sport, $teamsArray]);

		$this->assertInstanceOf('App\Models\Team', $res->first());

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
	public function event_serice_can_create_non_existing_location()
	{
		$locationData = [
			'title' => 'Title here',
			'zip' => 12345,
			'address' => 'Street here',
			'city' => 'City here',
			'country' => 'Country here'
		];

		$res = $this->callMethod(new EventService(), 'getLocationModel', [$locationData]);

		$this->assertInstanceOf('App\Models\Location', $res);

		$this->assertDatabaseHas('locations', [
			'title' => 'Title here',
			'zip' => 12345,
			'address' => 'Street here',
			'city' => 'City here',
			'country' => 'Country here'
		]);
	}
}
