<?php

namespace Tests\Feature\Authentication;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function registration_view_can_be_rendered()
    {
        $this->get('/register')->assertStatus(200);
    }

    /** @test */
    public function user_has_to_accept_terms()
    {
        $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ])->assertSessionHasErrors(['terms']);
    }

    /** @test */
    public function new_user_can_register()
    {
        $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'terms' => true,
        ])->assertRedirect(RouteServiceProvider::HOME);

        $this->assertAuthenticated();
    }
}
