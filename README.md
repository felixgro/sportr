# Meet Sportr

![Build Status](https://img.shields.io/travis/com/felixgro/sportr/master?style=flat-square) ![StyleCI](https://github.styleci.io/repos/329913094/shield?branch=master)

A clean & user-friendly sport event app for the web.
Built with Laravel 8, InteriaJs and VueJs.

## Setup
##### Prerequisites:
- PHP ^7.4
- MySQL

Begin by cloning this repository and install all dependencies:
```
git clone https://github.com/felixgro/sportr.git
cd sportr && composer install && npm install && npm run dev
```

Start a convenient, interactive terminal setup process for Sportr:
```
php artisan sportr:setup
```

Check out the [Setup Guide](_docs/SetupGuide.md) for detailed instructions on how to manually setup Sportr on your machine.

## Testing
You can find all tests in the `tests/` directory.

Run tests using the `php artisan test` or `vendor/bin/phpunit` command in the terminal.

Pull-Requests get automatically built and tested by [Travis-CI](https://www.travis-ci.com).