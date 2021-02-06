<?php

namespace Tests\Feature\Authorization;

use Tests\TestCase;

class AdminRoleTest extends TestCase
{
	/** @test */
	public function admin_can_view_dashboard()
	{
		$this->signIn('admin');

		$this->get(route('dashboard'))
			->assertOk();
	}
}
