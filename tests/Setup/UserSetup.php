<?php

namespace Tests\Setup;

use App\Models\User;
use Facades\App\Services\RoleService;
use Illuminate\Support\Facades\Hash;

class UserSetup
{
	private $attributes = [];

	public function create()
	{
		return User::factory()->create($this->attributes);
	}

	public function raw()
	{
		return User::factory()->raw($this->attributes);
	}

	public function withName(string $name)
	{
		$this->attributes['name'] = $name;

		return $this;
	}

	public function withEmail(string $email)
	{
		$this->attributes['email'] = $email;

		return $this;
	}

	public function withPassword(string $password)
	{
		$this->attributes['password'] = Hash::make($password);

		return $this;
	}

	public function withRole(string $role)
	{
		$this->attributes['role_id'] = RoleService::get($role)->id;

		return $this;
	}
}
