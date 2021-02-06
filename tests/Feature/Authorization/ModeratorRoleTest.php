<?php

namespace Tests\Feature\Authorization;

use App\Models\{Sport, Team};
use Tests\TestCase;

class ModeratorRoleTest extends TestCase
{
	/** @test */
	public function moderator_cannot_view_dashboard()
	{
		$this->signIn('moderator');

		$this->get(route('dashboard'))
			->assertForbidden();
	}

	/** @test */
	public function moderator_cannot_delete_sport()
	{
		$this->signIn('moderator');

		$sport = Sport::inRandomOrder()->first();

		$this->delete(route('sports.destroy', $sport))
			->assertForbidden();
	}

	/** @test */
	public function moderator_cannot_delete_team()
	{
		$this->signIn('moderator');

		$team = Team::factory()->create();

		$this->delete(route('sportteams.destroy', [$team->sport, $team]))
			->assertForbidden();
	}
}
