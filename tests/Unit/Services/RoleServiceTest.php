<?php

namespace Tests\Unit\Services;

use Facades\App\Services\RoleService;
use Tests\TestCase;

class RoleServiceTest extends TestCase
{
	/** @test */
	public function role_service_can_check_if_roles_ready()
	{
		$this->assertIsBool(RoleService::isReady());
	}

	/** @test */
	public function role_service_can_get_default_role()
	{
		$role = RoleService::getDefault();

		$this->assertInstanceOf('App\Models\Role', $role);
		$this->assertEquals(config('roles.default'), $role->title);
	}

	/** @test */
	public function role_service_can_get_any_role()
	{
		$role = RoleService::get('admin');

		$this->assertInstanceOf('App\Models\Role', $role);
		$this->assertEquals('admin', $role->title);
	}
}
