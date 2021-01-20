<?php

namespace Tests\Feature\Authentication;

use Tests\TestCase;

class UserRoleTest extends TestCase
{
	/** @test */
	public function users_cannot_view_dashboard()
	{
		$this->signIn();

		$this->get(route('dashboard'))
			->assertForbidden();
	}
}
