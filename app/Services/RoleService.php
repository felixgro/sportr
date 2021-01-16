<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    public function getAll(): array
    {
        return config('roles.all');
    }

    public function isSet()
    {
        $roles = Role::all();

        if ($roles->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkPermission(User $user, string $permission): bool
    {
        return false;
    }
}
