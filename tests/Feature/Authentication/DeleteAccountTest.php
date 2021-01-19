<?php

namespace Tests\Feature\Authentication;

use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    /** @test */
    public function user_accounts_can_be_deleted()
    {
        $user = $this->signIn();

        $this->delete('/user', [
            'password' => 'password',
        ]);

        $this->assertNull($user->fresh());
    }

    /** @test */
    public function correct_password_must_be_provided()
    {
        $user = $this->signIn();

        $this->delete('/user', [
            'password' => 'wrong-password',
        ]);

        $this->assertNotNull($user->fresh());
    }
}
