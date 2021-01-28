<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Admin User
    |--------------------------------------------------------------------------
    |
    | Specifies a default admin user for development. This user gets
    | stored via the Database Seeder or the sport:setup artisan command.
    | Login with the specified credentials to tinker with sportr.
    |
    */

    'admin' => [
        'name' => 'Admin',
        'email' => 'admin@email.com',
        'password' => '12345678',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Sports
    |--------------------------------------------------------------------------
    |
    | Specifies the default sports to generate when running
    | the `sport:setup` or `db:seed` artisan command in the terminal.
    | The Seeder will search for an SVG Icon using a kebab-cased
    | string from the sport's title.
    |
    | F.e.: 'American Football' should link to an Icon with the path:
    | 'ressources/icons/american-football.svg'.
    | Please make sure all necessary icons exist in that directory.
    |
    */

    'sports' => [
        'American Football',
        'Archery',
        'Badminton',
        'Baseball',
        'Basketball',
        'Billiards',
        'Bowling',
        'Boxing',
        'Curling',
        'Dart',
        'Golf',
        'Hockey',
        'Ice Skating',
        'Karate',
        'Ping Pong',
        'Rugby',
        'Skating',
        'Soccer',
        'Tennis'
    ]

];
