<?php

namespace Tests\Setup;

use App\Models\User;
use Laravel\Jetstream\Rules\Role;

class UserSetup
{
	private $attr;

	public function __construct()
	{
		//
	}

	public static function create($attr = [])
	{
		$usr = User::factory()->create($attr);

		return $usr;
	}

	public function assignRole(Role $role)
	{
		return $this;
	}
}
