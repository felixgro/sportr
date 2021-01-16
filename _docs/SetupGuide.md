## Sportr Setup Guide
#### Prerequisites:
- [PHP ^7.4](https://www.php.net/downloads.php)
- [MySQL](https://dev.mysql.com/doc/refman/8.0/en/getting-mysql.html)
- [Git](https://git-scm.com/downloads)
- [NPM](https://www.npmjs.com/get-npm) & [Composer](https://getcomposer.org/download/)

### Step 1: Install Sportr
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

Generate an application key:
```
php artisan key:generate
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
Migrate the database and seed it.
```
php artisan migrate
php artisan db:seed
```

### Step 4: Serve Sportr
Boot up Laravel's local development server.
```
php artisan serve
```
