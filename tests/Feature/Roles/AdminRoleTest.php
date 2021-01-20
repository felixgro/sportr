<?php

namespace Tests\Feature\Authentication;

use Tests\TestCase;

class AdminRoleTest extends TestCase
{
	/** @test */
	public function admins_can_view_dashboard()
	{
		$this->signIn('admin');

		$this->get(route('dashboard'))
			->assertOk();
	}
}
