<?php

namespace Tests\Unit\Models;

use App\Models\{User, Sport};
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function user_belongs_to_role()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf('App\Models\Role', $user->role);
    }

    /** @test */
    public function user_has_favorite_sports()
    {
        $user = User::factory()->create();
        $sports = Sport::inRandomOrder()->get()->pluck('id');

        $user->favSports()
            ->attach([$sports[0], $sports[1]]);

        $this->assertCount(2, $user->favSports);
        $this->assertInstanceOf('App\Models\Sport', $user->favSports->first());
    }
}
