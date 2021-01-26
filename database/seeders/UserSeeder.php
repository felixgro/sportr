<?php

namespace Database\Seeders;

use App\Models\User;
use Facades\App\Services\RoleService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return bool
     */
    public function run(): bool
    {
        if (User::all()->count() > 0) {
            return false;
        }

        $creds = config('sportr.admin');

        User::create([
            'name' => $creds['name'],
            'email' => $creds['email'],
            'password' => Hash::make($creds['password']),
            'email_verified_at' => now(),
            'role_id' => RoleService::get('admin')->id
        ]);

        return true;
    }
}
