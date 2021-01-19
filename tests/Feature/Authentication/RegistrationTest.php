<?php

namespace Tests\Feature\Authentication;

use App\Providers\RouteServiceProvider;
use Facades\App\Services\RoleService;
use Facades\Tests\Setup\UserSetup;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /** @test */
    public function registration_view_can_be_rendered()
    {
        $this->get('/register')->assertStatus(200);
    }

    /** @test */
    public function new_user_can_register()
    {
        $userData = UserSetup::raw();

        $this->post('/register', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => 'password',
            'terms' => true,
        ])->assertRedirect(RouteServiceProvider::HOME);

        $this->assertAuthenticated();
    }

    /** @test */
    public function new_user_gets_default_role()
    {
        $userData = UserSetup::raw();

        $this->post('/register', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => 'password',
            'terms' => true,
        ]);

        $user = UserSetup::getExisting($userData['email']);

        $this->assertEquals(RoleService::getDefault()->id, $user->role_id);
    }

    /** @test */
    public function user_has_to_accept_terms()
    {
        $userData = UserSetup::raw();

        $this->post('/register', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => 'password'
        ])->assertSessionHasErrors(['terms']);
    }
}
