<?php

namespace Database\Seeders;

use App\Models\Role;
use Facades\App\Services\RoleService;
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
        foreach (RoleService::getAll() as $role) {
            Role::create($role);
        }
    }
}
