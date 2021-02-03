## Sportr Setup Guide
#### Prerequisites:
- [PHP ^7.4, ^8.0](https://www.php.net/downloads.php)
- [MySQL ^5.7, ^8.0](https://dev.mysql.com/doc/refman/8.0/en/getting-mysql.html)
- [Composer](https://getcomposer.org/download/), [NPM](https://www.npmjs.com/get-npm)

Feel free to start an automated setup process using the `php artisan sportr:setup` command. Nevertheless you can setup the application manually as well using the following 5 steps:

### Step 1: Install Sportr with dependencies
Clone this Repository to your machine:
```
git clone https://github.com/felixgro/sportr.git
cd sportr
```
Install Composer/NPM dependencies:
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
Generate an application key:
```
php artisan key:generate
```

### Step 3: Prepare Database
Migrate the database and seed it with essential data.
```
php artisan migrate
php artisan db:seed
```

### Step 4: Prepare public storage
Link the `storage/public` directory to `public/storage` to serve assets public.
```
php artisan storage:link
```

### Step 5: Serve Sportr
Boot up local development server:
```
php artisan serve
```

..or use [Laravel Valet](https://laravel.com/docs/8.x/valet) to serve the app on `http://sportr.test`.

## Having Troubles ?
Check out the [Troubleshootings](Troubleshootings.md).
