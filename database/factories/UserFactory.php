<?php

namespace Database\Factories;

use App\Models\User;
use Facades\App\Services\RoleService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'role_id' => RoleService::getDefault()->id,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Set custom password.
     *
     * @param string $role
     * @return static
     */
    public function withPassword(string $password)
    {
        return $this->state(function () use ($password) {
            return [
                'password' => Hash::make($password)
            ];
        });
    }

    /**
     * Set custom role.
     *
     * @param string $role
     * @return static
     */
    public function withRole(string $role)
    {
        return $this->state(function () use ($role) {
            return [
                'role_id' => RoleService::get($role)->id
            ];
        });
    }

    /**
     * Set email to not verified.
     *
     * @return static
     */
    public function notVerified()
    {
        return $this->state(function () {
            return [
                'email_verified_at' => null
            ];
        });
    }
}
