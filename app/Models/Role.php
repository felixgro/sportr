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
