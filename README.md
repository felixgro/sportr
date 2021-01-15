# Meet Sportr

[![Build Status](https://www.travis-ci.com/felixgro/sportr.svg?branch=master)](https://www.travis-ci.com/felixgro/sportr)

A clean & user-friendly sport event app for the web.
Built with Laravel 8, Interia.js and Vue.

## Setup

#### Prerequisites
- PHP ^7.3 or ^8.0
- MySQL

#### Step 1
Clone this repository to your machine, and install all Composer & NPM dependencies.
```
$ git clone https://github.com/felixgro/sportr.git
$ cd sportr
$ composer install
$ npm install
$ npm run dev
```

#### Step 2
Prepare the .env file: Start by dublicating and renaming the .env.example file.
```
$ cp .env.example .env
```
Setup a MySQL Database and enter the credentials in the .env file.
```
...
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=sportr
DB_USERNAME=root
DB_PASSWORD=
DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock
...
```

#### Step 3
Migrate Database and optionally seed it.
```
$ php artisan migrate
$ php artisan db:seed
```

#### Step 4
Start backend & frontend local development servers.
```
$ php artisan serve
```