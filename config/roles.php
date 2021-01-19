<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default User Role
    |--------------------------------------------------------------------------
    |
    | Specify the default role for freshly registered users.
    |
    */

    'default' => 'user',

    /*
    |--------------------------------------------------------------------------
    | List of supported Roles
    |--------------------------------------------------------------------------
    |
    | Here you can specify the complete list of supported user roles.
    | Each Role has a title and permissions. You can also define
    | an optional inherit property to obtain permissions of a different role.
    |
    */

    'all' => [
        [
            'role' => 'user',
            'permissions' => []
        ],
        [
            'role' => 'moderator',
            'permissions' => ['edit-event']
        ],
        [
            'role' => 'admin',
            'permissions' => ['delete-event', 'edit-roles'],
            'inherit' => 'moderator'
        ]
    ]
];
