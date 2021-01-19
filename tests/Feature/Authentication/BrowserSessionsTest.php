<?php

namespace Tests\Feature\Authentication;

use Facades\Tests\Setup\UserSetup;
use Tests\TestCase;

class BrowserSessionsTest extends TestCase
{
    /** @test */
    public function other_browser_sessions_can_be_logged_out()
    {
        $user = UserSetup::create();

        $this->actingAs($user);

        $this->delete('/user/other-browser-sessions', [
            'password' => 'password',
        ])->assertSessionHasNoErrors();
    }
}
