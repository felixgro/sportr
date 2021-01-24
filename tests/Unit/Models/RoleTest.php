<?php

namespace Tests\Unit\Models;

use App\Models\{User, Role};
use Tests\TestCase;

class RoleTest extends TestCase
{
    /** @test */
    public function role_has_many_users()
    {
        $role = Role::find(User::factory()->create()->role_id);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $role->users);
        $this->assertInstanceOf('App\Models\User', $role->users->first());
    }

    /** @test */
    public function role_can_get_all_its_permissions()
    {
        $this->assertIsArray(Role::find(1)->allPermissions);
    }

    /** @test */
    public function role_can_check_if_it_contains_a_permission()
    {
        $role = Role::find(1);

        $this->assertIsBool($role->hasPermission('edit-event'));
    }
}
