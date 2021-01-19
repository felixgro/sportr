<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    /**
     * Get a Role's ORM by its title.
     *
     * @param string $title
     * @return Role
     */
    public function get(string $title)
    {
        return Role::where('title', $title)->first();
    }

    /**
     * Checks if roles have been stored in database.
     *
     * @return bool
     */
    public function isReady()
    {
        return !Role::all()->isEmpty();
    }

    /**
     * Get the default Role ORM.
     *
     * @return Role
     */
    public function getDefault()
    {
        return Role::where('title', $this->config('default'))->first();
    }

    /**
     * Get value of given key from config/roles.php
     *
     * @param string $key
     * @return mixed
     */
    public function config($key)
    {
        return config('roles.' . $key);
    }
}
