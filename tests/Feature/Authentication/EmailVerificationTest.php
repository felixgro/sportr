<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    /** @test */
    public function email_verification_view_can_be_rendered()
    {
        $user = User::factory()->notVerified()->create();

        $this->actingAs($user)
            ->get('/email/verify')
            ->assertStatus(200);
    }

    /** @test */
    public function email_can_be_verified()
    {
        Event::fake();

        $user = User::factory()->notVerified()->create();

        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $this->actingAs($user)
            ->get($url)
            ->assertRedirect(RouteServiceProvider::HOME . '?verified=1');

        Event::assertDispatched(Verified::class);
    }

    /** @test */
    public function email_can_not_be_verified_with_invalid_hash()
    {
        $user = User::factory()->notVerified()->create();

        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($user)
            ->get($url);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}
