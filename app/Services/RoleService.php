<?php

namespace App\Services;

class RoleService
{
    public function getAll(): array
    {
        return config('roles.all');
    }

    public function checkPermission(User $user, string $permission): bool
    {
        return false;
    }
}
