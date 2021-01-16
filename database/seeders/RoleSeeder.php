<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Store Roles in Database.
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
