<?php

namespace Tests\Unit\Models;

use App\Models\Role;
use Facades\Tests\Setup\UserSetup;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /** @test */
    public function a_role_has_many_users()
    {
        $role = Role::find(UserSetup::create()->role_id);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $role->users);
        $this->assertInstanceOf('App\Models\User', $role->users->first());
    }
}
