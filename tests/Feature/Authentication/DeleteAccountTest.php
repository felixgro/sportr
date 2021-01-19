<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Facades\Tests\Setup\UserSetup;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    /** @test */
    public function user_accounts_can_be_deleted()
    {
        $user = UserSetup::create();

        $this->actingAs($user);

        $this->delete('/user', [
            'password' => 'password',
        ]);

        $this->assertNull($user->fresh());
    }

    /** @test */
    public function correct_password_must_be_provided()
    {
        $user = UserSetup::create();

        $this->actingAs($user);

        $this->delete('/user', [
            'password' => 'wrong-password',
        ]);

        $this->assertNotNull($user->fresh());
    }
}
