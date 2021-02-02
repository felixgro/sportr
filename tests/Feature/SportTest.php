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
    public function sports_view_can_be_rendered()
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
    public function edit_sport_view_can_be_rendered()
    {
        $this->signIn($this->role);

        $this->get(route('sports.edit', 1))->assertStatus(200);
    }

    /** @test */
    public function sport_can_be_created()
    {
        $this->signIn($this->role);

        Storage::fake('public');

        $this->post(route('sports.store'), [
            'title' => 'New Sport Title',
            'icon' => UploadedFile::fake()->image('new_icon.svg')
        ])->assertRedirect();

        $sport = Sport::where('title', 'New Sport Title')->first();

        $this->assertTrue(Storage::disk('public')->exists($sport->relIconPath()));
    }

    /** @test */
    public function sport_can_be_updated()
    {
        $this->signIn($this->role);

        Storage::fake('public');

        $this->post(route('sports.store'), [
            'title' => 'New Sport Title 2',
            'icon' => UploadedFile::fake()->image('new_icon.svg')
        ])->assertRedirect();

        $sport = Sport::where('title', 'New Sport Title 2')->first();

        $this->put(route('sports.update', $sport), [
            'title' => 'Updated Sport Title',
            'icon' => UploadedFile::fake()->image('updated_icon.svg')
        ]);

        $this->assertFalse(Storage::disk('public')->exists($sport->relIconPath()));
        $this->assertTrue(Storage::disk('public')->exists($sport->fresh()->relIconPath()));
        $this->assertDatabaseHas('sports', ['title' => 'Updated Sport Title']);
    }

    /** @test */
    public function sport_can_be_deleted()
    {
        $this->signIn($this->role);

        $this->delete(route('sports.destroy', 1));

        $this->assertDatabaseMissing('sports', ['id' => 1]);
    }
}
