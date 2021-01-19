<?php

namespace Tests\Feature\Authentication;

use Facades\Tests\Setup\UserSetup;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    /** @test */
    public function profile_information_can_be_updated()
    {
        $user = UserSetup::create();
        $newData = UserSetup::raw();

        $this->actingAs($user)
            ->put('/user/profile-information', [
                'name' => $newData['name'],
                'email' => $newData['email'],
            ]);

        $this->assertEquals($newData['name'], $user->fresh()->name);
        $this->assertEquals($newData['email'], $user->fresh()->email);
    }
}
