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
     * @return bool
     */
    public function run(): bool
    {
        // Check if roles are already stored
        if (RoleService::isReady()) {
            return false;
        }

        foreach (RoleService::config('all') as $r) {
            Role::create([
                'title' => $r['role'],
                'permissions' => $r['permissions'],
                'inherit' => $r['inherit'] ?? null
            ]);
        }

        return true;
    }
}
