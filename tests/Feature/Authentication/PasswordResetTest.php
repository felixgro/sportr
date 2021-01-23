<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    /** @test */
    public function forgot_password_view_can_be_rendered()
    {
        $this->get('/forgot-password')->assertStatus(200);
    }

    /** @test */
    public function reset_password_link_can_be_requested()
    {
        Notification::fake();

        $user = User::factory()->create();;

        $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    /** @test */
    public function reset_password_view_can_be_rendered()
    {
        Notification::fake();

        $user = User::factory()->create();;

        $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $this->get('/reset-password/' . $notification->token)
                ->assertStatus(200);

            return true;
        });
    }

    /** @test */
    public function password_can_be_reset_with_valid_token()
    {
        Notification::fake();

        $user = User::factory()->create();;

        $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ])->assertSessionHasNoErrors();

            return true;
        });
    }
}
