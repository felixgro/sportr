<?php

namespace Tests\Feature;

use App\Models\{Sport, Team};
use Tests\TestCase;

class TeamTest extends TestCase
{
    private $role = 'admin';

    /** @test */
    public function teams_view_can_be_rendered()
    {
        $sport = Sport::inRandomOrder()->first();

        $this->get(route('sportteams.index', $sport))->assertStatus(200);
    }

    /** @test */
    public function single_team_view_can_be_rendered()
    {
        $team = Team::factory()->create();

        $this->get(route('sportteams.show', [$team->sport, $team]))->assertStatus(200);
    }

    /** @test */
    public function create_team_view_can_be_rendered()
    {
        $this->signIn($this->role);

        $sport = Sport::inRandomOrder()->first();

        $this->get(route('sportteams.create', $sport))
            ->assertStatus(200);
    }

    /** @test */
    public function edit_team_view_can_be_rendered()
    {
        $this->signIn($this->role);

        $team = Team::factory()->create();

        $this->get(route('sportteams.edit', [$team->sport, $team]))
            ->assertStatus(200);
    }

    /** @test */
    public function team_can_be_created()
    {
        $this->signIn($this->role);

        $sport = Sport::inRandomOrder()->first();

        $this->post(route('sportteams.store', $sport), [
            'title' => 'team1'
        ])->assertRedirect();

        $this->assertDatabaseHas('teams', [
            'title' => 'team1',
            'sport_id' => $sport->id
        ]);
    }

    /** @test */
    public function team_can_be_updated()
    {
        $this->signIn($this->role);

        $team = Team::factory()->create();

        $this->put(route('sportteams.update', [$team->sport, $team]), [
            'title' => 'new team title'
        ])->assertRedirect();

        $this->assertDatabaseHas('teams', [
            'title' => 'new team title'
        ]);
    }

    /** @test */
    public function team_can_be_deleted()
    {
        $this->signIn($this->role);

        $team = Team::factory()->create();

        $this->delete(route('sportteams.destroy', [$team->sport, $team]));

        $this->assertDatabaseMissing('teams', $team->only('id', 'title', 'sport_id'));
    }
}
