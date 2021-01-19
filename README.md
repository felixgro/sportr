# Meet Sportr

![Build Status](https://img.shields.io/travis/com/felixgro/sportr/master?style=flat-square) ![StyleCI](https://github.styleci.io/repos/329913094/shield?branch=master)

A clean & user-friendly sport event app for the web.
Built with Laravel 8, InteriaJs and VueJs.

## Setup
##### Prerequisites:
- PHP 7.4, 8.x
- MySQL 5.7, 8.x
- Composer, NPM

1.  Begin by cloning this repository and install all dependencies:
```
git clone https://github.com/felixgro/sportr.git
cd sportr && composer install && npm install && npm run dev
```
2. Start a convenient terminal setup process:
```
php artisan sportr:setup
```
3. Serve Sportr using [Valet](https://laravel.com/docs/8.x/valet) or run:
```
php artisan serve
```

Check out the [Setup Guide](_docs/SetupGuide.md) for detailed instructions on how to manually setup Sportr on your machine.

## Testing
You can find all tests in the `tests/` directory.

Run tests using the `php artisan test` or `vendor/bin/phpunit` command in the terminal.

Pull-Requests get automatically built and tested by [Travis-CI](https://www.travis-ci.com).
