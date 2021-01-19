<?php

namespace Tests\Feature\Authentication;

use App\Providers\RouteServiceProvider;
use Facades\Tests\Setup\UserSetup;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function login_view_can_be_rendered()
    {
        $this->get('/login')->assertStatus(200);
    }

    /** @test */
    public function user_can_login_using_the_login_view()
    {
        $user = UserSetup::create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(RouteServiceProvider::HOME);

        $this->assertAuthenticated();
    }

    /** @test */
    public function user_can_not_login_with_invalid_password()
    {
        $user = UserSetup::create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
