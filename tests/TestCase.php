<?php

namespace Tests;

use App\Models\User;
use Tests\ApplicationSetup;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use ApplicationSetup;

    /**
     * Creates and signs in user with given role.
     *
     * @param  string $role
     * @return App\Model\User
     */
    protected function signIn(string $role = 'user')
    {
        $usr = User::factory()->withRole($role)->create();

        $this->actingAs($usr);

        return $usr;
    }

    /**
     * Calls private or protected methods through
     * a reflection class.
     *
     * @param  object $obj
     * @param  string $name
     * @param  array $params
     * @return mixed
     */
    protected function callMethod(object $obj, string $name, array $params)
    {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $params);
    }
}
