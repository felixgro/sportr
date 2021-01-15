<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Store Roles in Database
     *
     * @return void
     */
    public function run()
    {
        foreach (config('roles.all') as $role) {
            Role::create($role);
        }
    }
}
