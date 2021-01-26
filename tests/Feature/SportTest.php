<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Sport;
use Tests\TestCase;

class SportTest extends TestCase
{

    private $role = 'admin';

    /** @test */
    public function sport_view_can_be_rendered()
    {
        $this->get(route('sports.index'))->assertStatus(200);
    }

    /** @test */
    public function create_sport_view_can_be_rendered()
    {
        $this->signIn($this->role);

        $this->get(route('sports.create'))->assertStatus(200);
    }

    /** @test */
    public function new_sport_can_be_created()
    {
        $this->signIn($this->role);

        Storage::fake();

        $this->post(route('sports.store'), [
            'title' => 'New Sport Title',
            'icon' => UploadedFile::fake()->image('new_icon.svg')
        ])->assertRedirect();

        $sport = Sport::where('title', 'New Sport Title')->first();

        Storage::assertExists($sport->icon);
    }

    /** @test */
    public function new_sport_can_be_updated()
    {
        $this->signIn($this->role);

        Storage::fake();

        $this->post(route('sports.store'), [
            'title' => 'New Sport Title 2',
            'icon' => UploadedFile::fake()->image('new_icon.svg')
        ])->assertRedirect();

        $sport = Sport::where('title', 'New Sport Title 2')->first();

        $this->put(route('sports.update', $sport), [
            'title' => 'Updated Sport Title',
            'icon' => UploadedFile::fake()->image('updated_icon.svg')
        ]);

        Storage::assertMissing($sport->icon);
        Storage::assertExists($sport->fresh()->icon);
        $this->assertDatabaseHas('sports', ['title' => 'Updated Sport Title']);
    }
}
