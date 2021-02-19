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
    | Available permissions
    | Sport:  edit-sport / delete-sport
    | Teams:  edit-team  / delete-team
    | Events: remember-event / edit-event / delete-event
    | Other:  assign-role / edit-report / view-dashboard
    */

    'all' => [
        [
            'role' => 'user',
            'permissions' => [
                'remember-event'
            ]
        ],
        [
            'role' => 'moderator',
            'inherit' => 'user',
            'permissions' => [
                'edit-sport',
                'edit-team',
                'edit-event',
                'edit-report',
                'delete-event'
            ]
        ],
        [
            'role' => 'admin',
            'inherit' => 'moderator',
            'permissions' => [
                'view-dashboard',
                'assign-role',
                'delete-sport',
                'delete-team'
            ]
        ]
    ]
];
