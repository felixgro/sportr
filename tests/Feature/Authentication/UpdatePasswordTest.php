<?php

namespace Tests\Feature\Authentication;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdatePasswordTest extends TestCase
{
    /** @test */
    public function password_can_be_updated()
    {
        $user = $this->signIn();

        $this->put('/user/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }

    /** @test */
    public function current_password_must_be_correct()
    {
        $this->signIn();

        $this->put('/user/password', [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])->assertSessionHasErrors();
    }
}
