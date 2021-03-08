## Sportr Setup Guide
#### Prerequisites:
- [PHP ^7.4, ^8.0](https://www.php.net/downloads.php)
- [MySQL ^5.7, ^8.0](https://dev.mysql.com/doc/refman/8.0/en/getting-mysql.html)
- [Composer](https://getcomposer.org/download/), [NPM](https://www.npmjs.com/get-npm)

Once you installed all composer and npm dependencies feel free to start a convenient automated setup process using one of the following commands:
```shell
php artisan setup:local  # Setup Sportr on your system
php artisan setup:docker # Setup Sportr on docker
```

Nevertheless you can setup the application manually as well using the following guide:

### Step 1: Install Sportr with dependencies
Clone this Repository to your machine:
```shell
git clone https://github.com/felixgro/sportr.git
cd sportr
```
Install Composer/NPM dependencies:
```shell
composer install
npm install
```
Compile frontend files:
```shell
npm run dev
```

### Step 2: Prepare `.env` file
Start by duplicating and renaming the `.env.example` file to `.env`:
```shell
cp .env.example .env
```
Setup a MySQL database and enter the correct credentials in the new `.env` file:
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
```shell
php artisan key:generate
```

### Step 3: Prepare Database
Create the specified database on your system. Feel free to use this handy artisan command and let sportr do the work for you:
```shell
php artisan db:make
```
This command will search for the specified database name on the given mysql host. If no database exists, a new one will be created. A
seperate testing database with the suffix `*_test` will be created as well. If you only care about the main database append the `--no-test` flag:
```shell
php artisan db:make --no-test
```

Migrate the database and seed it with essential data.
```shell
php artisan migrate
php artisan db:seed
```

optionally: Seed database with fake sport events:
```shell
php artisan db:seed --class=EventSeeder
```

### Step 4: Prepare public storage
Link the `storage/public` directory to `public/storage` to serve public assets.
```shell
php artisan storage:link
```

### Step 5: Serve Sportr
Boot up local development server:
```shell
php artisan serve
```

..or use [Laravel Valet](https://laravel.com/docs/8.x/valet) to serve the app on `http://sportr.test`.

## Having Troubles ?
Check out the [Troubleshootings](Troubleshootings.md).
