## Sportr Setup Guide

Step-by-step guide to setting up Sportr on your local machine.

#### Prerequisites:
- PHP ^7.4
- MySQL

### Step 1: Prepare Repository
Clone this Repository to your machine:
```
git clone https://github.com/felixgro/sportr.git
cd sportr
```
Install Composer and NPM dependencies:
```
composer install
npm install
```
Compile frontend files:
```
npm run dev
```

### Step 2: Prepare `.env` file
Start by duplicating and renaming the `.env.example` file:
```
cp .env.example .env
```
Setup a MySQL database and enter the correct credentials in the `.env` file:
```
...
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=sportr
DB_USERNAME=root
DB_PASSWORD=
...
```
If you receive a `SQLSTATE[HY000] [2002]` error while migrating the database you might also have to specify the path to your local MySQL Socket file:
```
...
DB_SOCKET=/path/to/mysql.sock
...
```

### Step 3: Prepare Database
Migrate the database and optionally seed it with fake data.
```
php artisan migrate
php artisan db:seed
```

### Step 4: Serve Sportr
Start local development server.
```
php artisan serve
```

Watch frontend files for changes and auto-compile accordingly via the `npm run watch` command.