<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function user_belongs_to_role()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf('App\Models\Role', $user->role);
    }
}
