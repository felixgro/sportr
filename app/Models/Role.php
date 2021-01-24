<?php

namespace App\Models;

use Facades\App\Services\RoleService;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'inherit',
        'permissions',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    protected $appends = [
        'allPermissions'
    ];

    /**
     * Get all users with the current role.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all permissions of a given role and include
     * all parent role permissions from the role's hierachy.
     *
     * @return array
     */
    public function getAllPermissionsAttribute()
    {
        $permissions = $this->permissions;

        $role = $this;
        while ($currentRole = $role->inherit) {
            $role = RoleService::get($currentRole);
            $permissions = array_merge($permissions, $role->permissions);
        }

        return $permissions;
    }

    /**
     * Check if role has given permission.
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission)
    {
        if (in_array($permission, $this->permissions)) {
            return true;
        }

        if ($this->inherit) {
            // Recursively search in parent roles
            return RoleService::get($this->inherit)->hasPermission($permission);
        }

        // Permission not found
        return false;
    }
}
