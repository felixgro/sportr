<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Location;
use App\Models\Sport;
use App\Models\Team;
use Tests\TestCase;

class EventTest extends TestCase
{

    private $role = 'moderator';

    /** @test */
    public function events_view_can_be_rendered()
    {
        $sport = Sport::inRandomOrder()->first();

        $this->get(route('sportevents.index', $sport))
            ->assertStatus(200);
    }

    /** @test */
    public function single_event_view_can_be_rendered()
    {
        $event = Event::factory()->create();

        $this->get(route('sportevents.show', [$event->sport, $event]))
            ->assertStatus(200);
    }

    /** @test */
    public function create_event_view_can_be_rendered()
    {
        $this->signIn($this->role);

        $sport = Sport::inRandomOrder()->first();

        $this->get(route('sportevents.create', $sport))
            ->assertStatus(200);
    }

    /** @test */
    public function edit_event_view_can_be_rendered()
    {
        $this->signIn($this->role);

        $event = Event::factory()->create();

        $this->get(route('sportevents.edit', [$event->sport, $event]))
            ->assertStatus(200);
    }

    /** @test */
    public function event_can_be_created()
    {
        $sport = Sport::inRandomOrder()->first();
        $location = Location::factory()->create();
        $teams = Team::factory()->for($sport)->count(2)->create();

        $requestData = [
            'title' => 'Event Title',
            'date' => now(),
            'location' => $location->id,
            'teams' => [
                [
                    'id' => $teams[0]->id,
                    'score' => 2
                ],
                [
                    'id' => $teams[1]->id,
                    'score' => 0
                ]
            ]
        ];

        $this->signIn($this->role);

        $this->post(route('sportevents.store', $sport), $requestData)
            ->assertRedirect();

        $event = Event::where('title', 'Event Title')->first();

        $this->assertNotNull($event);
        $this->assertCount(2, $event->teams);
        $this->assertInstanceOf('App\Models\Location', $event->location);
    }

    /** @test */
    public function event_can_be_created_along_with_teams_and_location()
    {
        $sport = Sport::inRandomOrder()->first();

        $requestData = [
            'title' => 'Event Title',
            'date' => now(),
            'location' => [
                'title' => 'Some Place'
            ],
            'teams' => [
                [
                    'team' => [
                        'title' => 'Team 1'
                    ],
                    'score' => null
                ],
                [
                    'team' => [
                        'title' => 'Team 2'
                    ],
                    'score' => null
                ]
            ]
        ];

        $this->signIn($this->role);

        $this->post(route('sportevents.store', $sport), $requestData)
            ->assertRedirect();

        $this->assertDatabaseHas('teams', ['title' => 'Team 1']);
        $this->assertDatabaseHas('teams', ['title' => 'Team 2']);
        $this->assertDatabaseHas('locations', ['title' => 'Some Place']);
    }

    /** @test */
    public function event_can_be_updated()
    {
        $event = Event::factory()->create();

        $teams = Team::factory()->for($event->sport)
            ->count(2)
            ->create()
            ->mapWithKeys(fn ($t) => [$t['id'] => ['score' => null]]);

        $event->teams()->attach($teams);

        $teamIds = array_keys($teams->toArray());

        $requestData = [
            'title' => 'Updated Title',
            'date' => now(),
            'location' => [
                'title' => 'New Location'
            ],
            'teams' => [
                [
                    'id' => $teamIds[0],
                    'score' => 2
                ],
                [
                    'id' => $teamIds[1],
                    'score' => 1
                ]
            ]
        ];

        $this->signIn($this->role);

        $this->put(route('sportevents.update', [$event->sport, $event]), $requestData)
            ->assertRedirect();

        $event = $event->fresh();

        $this->assertEquals('New Location', $event->location->title);
        $this->assertEquals('Updated Title', $event->title);
        $this->assertEquals(2, $event->teams->first()->score->score);

        $this->assertDatabaseMissing('event_team', [
            'team_id' => $teamIds[0],
            'event_id' => $event->id,
            'score' => null
        ]);
    }

    /** @test */
    public function event_can_be_deleted()
    {
        $event = Event::factory()->create();

        $teams = Team::factory()->for($event->sport)
            ->count(2)
            ->create()
            ->mapWithKeys(fn ($t) => [$t['id'] => ['score' => null]]);

        $event->teams()->attach($teams);

        $this->signIn($this->role);

        $this->delete(route('sportevents.destroy', [$event->sport, $event]))
            ->assertRedirect();

        $this->assertDatabaseMissing('events', $event->only('id', 'title'));
        $this->assertDatabaseMissing('event_team', ['event_id' => $event->id]);
        $this->assertDatabaseHas('teams', ['id' => array_key_first($teams->toArray())]);
    }
}
