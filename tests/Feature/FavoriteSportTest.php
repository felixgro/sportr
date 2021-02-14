<?php

namespace Tests\Feature;

use App\Models\Sport;
use Tests\TestCase;

class FavoriteSportTest extends TestCase
{
	/** @test */
	public function only_authenticated_user_can_request_fav_sports_routes()
	{
		$this->get(route('favsports.index'))
			->assertRedirect(route('login'));

		$this->post(route('favsports.store'))
			->assertRedirect(route('login'));

		$this->put(route('favsports.update'))
			->assertRedirect(route('login'));
	}

	/** @test */
	public function favorite_sports_can_be_requested()
	{
		$this->signIn();

		$this->get(route('favsports.index'))
			->assertOk();
	}

	/** @test */
	public function favorite_sports_can_be_assigned_to_user()
	{
		$sports = Sport::inRandomOrder()->get()->pluck('id');

		$requestData = [
			$sports[0],
			$sports[1],
			$sports[2],
		];

		$user = $this->signIn();

		$this->post(route('favsports.store'), $requestData)
			->assertRedirect();

		$this->assertCount(3, $user->favSports);
		$this->assertInstanceOf('App\Models\Sport', $user->favSports->first());
	}

	/** @test */
	public function favorite_sports_can_be_updated()
	{
		$sports = Sport::inRandomOrder()->get()->pluck('id');

		$user = $this->signIn();

		// Assign previous favorite sports
		$user->favSports()->attach([$sports[0], $sports[1]]);

		// Update favorite sports
		$this->put(route('favsports.update'), [$sports[2], $sports[3]])
			->assertRedirect();

		$this->assertCount(2, $user->favSports);

		// Previous fav sports get removed.
		$this->assertDatabaseMissing('sport_user', [
			'sport_id' => $sports[0],
			'user_id' => $user->id
		]);
		$this->assertDatabaseMissing('sport_user', [
			'sport_id' => $sports[1],
			'user_id' => $user->id
		]);

		// New fav sports get stored.
		$this->assertDatabaseHas('sport_user', [
			'sport_id' => $sports[2],
			'user_id' => $user->id
		]);
		$this->assertDatabaseHas('sport_user', [
			'sport_id' => $sports[3],
			'user_id' => $user->id
		]);
	}
}
