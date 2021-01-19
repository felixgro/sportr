<?php

namespace Tests\Feature\Authentication;

use Tests\TestCase;

class TwoFactorAuthenticationSettingsTest extends TestCase
{
    /** @test */
    public function two_factor_authentication_can_be_enabled()
    {
        $user = $this->signIn();

        $this->withSession(['auth.password_confirmed_at' => time()])
            ->post('/user/two-factor-authentication');

        $this->assertNotNull($user->fresh()->two_factor_secret);
        $this->assertCount(8, $user->fresh()->recoveryCodes());
    }

    /** @test */
    public function recovery_codes_can_be_regenerated()
    {
        $user = $this->signIn();

        $this->withSession(['auth.password_confirmed_at' => time()]);

        $this->post('/user/two-factor-authentication');
        $this->post('/user/two-factor-recovery-codes');

        $user = $user->fresh();

        $this->post('/user/two-factor-recovery-codes');

        $this->assertCount(8, $user->recoveryCodes());
        $this->assertCount(8, array_diff($user->recoveryCodes(), $user->fresh()->recoveryCodes()));
    }

    /** @test */
    public function two_factor_authentication_can_be_disabled()
    {
        $user = $this->signIn();

        $this->withSession(['auth.password_confirmed_at' => time()]);

        $this->post('/user/two-factor-authentication');

        $this->assertNotNull($user->fresh()->two_factor_secret);

        $this->delete('/user/two-factor-authentication');

        $this->assertNull($user->fresh()->two_factor_secret);
    }
}
