# Meet Sportr

[![Build Status](https://www.travis-ci.com/felixgro/sportr.svg?branch=master)](https://www.travis-ci.com/felixgro/sportr)

A clean & user-friendly sport event app for the web.
Built with Laravel 8, InteriaJs and VueJs.

## Setup

#### Prerequisites
- PHP ^7.4
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
Prepare the `.env` file: Start by duplicating and renaming the `.env.example` file.
```
$ cp .env.example .env
```
Setup a MySQL database and enter the credentials in the `.env` file.
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
Migrate the database and optionally seed it.
```
$ php artisan migrate
$ php artisan db:seed
```

#### Step 4
Start local development server.
```
$ php artisan serve
```

## Testing

You can find all tests in the `tests/` directory.

Run tests using the `php artisan test` or `vendor/bin/phpunit` command in the terminal.

Pull-Requests get automatically built and tested by [Travis-CI](https://www.travis-ci.com).
