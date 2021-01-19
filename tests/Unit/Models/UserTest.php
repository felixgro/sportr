<?php

namespace Tests\Unit\Models;

use Facades\Tests\Setup\UserSetup;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function a_user_has_one_role()
    {
        $user = UserSetup::create();
        $this->assertInstanceOf('App\Models\Role', $user->role);
    }
}
