<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    /** @test */
    public function profile_information_can_be_updated()
    {
        $user = $this->signIn();

        $updatedData = User::factory()->raw();

        $this->put('/user/profile-information', [
            'name' => $updatedData['name'],
            'email' => $updatedData['email'],
        ]);

        $this->assertEquals($updatedData['name'], $user->fresh()->name);
        $this->assertEquals($updatedData['email'], $user->fresh()->email);
    }
}
