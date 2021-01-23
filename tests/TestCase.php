<?php

namespace Tests;

use App\Models\User;
use Tests\Setup\ApplicationSetup;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use ApplicationSetup;

    /**
     * Creates and signs in user with given role.
     *
     * @param string $role
     * @return App\Model\User
     */
    protected function signIn(string $role = 'user')
    {
        $usr = User::factory()->withRole($role)->create();

        $this->actingAs($usr);

        return $usr;
    }
}
