<?php

namespace Tests\Setup;

use App\Models\User;
use Facades\App\Services\RoleService;
use Illuminate\Support\Facades\Hash;

class UserSetup
{
	/**
	 * Custom user attributes.
	 *
	 * @var array
	 */
	private $attributes = [];

	/**
	 * Stores and returns new user.
	 *
	 * @return App\Models\User
	 */
	public function create()
	{
		return User::factory()->create($this->attributes);
	}

	/**
	 * Returns user's data without storing it in database.
	 *
	 * @return array
	 */
	public function raw()
	{
		return User::factory()->raw($this->attributes);
	}

	/**
	 * Set custom name.
	 *
	 * @param string $name
	 * @return UserSetup
	 */
	public function withName(string $name)
	{
		$this->attributes['name'] = $name;

		return $this;
	}

	/**
	 * Set custom email.
	 *
	 * @param string $email
	 * @return UserSetup
	 */
	public function withEmail(string $email)
	{
		$this->attributes['email'] = $email;

		return $this;
	}

	/**
	 * Set custom password.
	 *
	 * @param string $password
	 * @return UserSetup
	 */
	public function withPassword(string $password)
	{
		$this->attributes['password'] = Hash::make($password);

		return $this;
	}

	/**
	 * Set custom role.
	 *
	 * @param string $role
	 * @return UserSetup
	 */
	public function withRole(string $role)
	{
		$this->attributes['role_id'] = RoleService::get($role)->id;

		return $this;
	}

	/**
	 * Set email to unverified.
	 *
	 * @return UserSetup
	 */
	public function notVerified()
	{
		$this->attributes['email_verified_at'] = null;

		return $this;
	}

	/**
	 * Returns an existing user.
	 *
	 * @return App\Models\User
	 */
	public function getExisting($value, string $col = 'email')
	{
		return User::where($col, $value)->first();
	}
}
