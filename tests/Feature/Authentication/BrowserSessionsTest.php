<?php

namespace Tests\Feature\Authentication;

use Tests\TestCase;

class BrowserSessionsTest extends TestCase
{
    /** @test */
    public function other_browser_sessions_can_be_logged_out()
    {
        $this->signIn();

        $this->delete('/user/other-browser-sessions', [
            'password' => 'password',
        ])->assertSessionHasNoErrors();
    }
}
