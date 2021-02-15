<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Facades\App\Services\RoleService;
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
        $userData = User::factory()->raw();

        $this->post('/register', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password'],
            'terms' => true,
        ])->assertRedirect(route('favsports.index'));

        $this->assertAuthenticated();
    }

    /** @test */
    public function new_user_gets_default_role()
    {
        $userData = User::factory()->raw();

        $this->post('/register', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password'],
            'terms' => true,
        ]);

        $newUser = User::where('email', $userData['email'])->first();

        $this->assertEquals(RoleService::getDefault()->id, $newUser->role_id);
    }

    /** @test */
    public function user_has_to_accept_terms()
    {
        $userData = User::factory()->raw();

        $this->post('/register', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password']
        ])->assertSessionHasErrors(['terms']);
    }
}
