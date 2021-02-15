# Troubleshootings
List of common problems along with instructions on how to fix and prevent them.

No solution for your problem? Feel free to send an email to [me@felixgrohs.at](mailto:me@felixgrohs.at) and I'll be happy to help you out.

### Public storage
If you receive a `404 Not Found Error` when requesting assets from the client-side you might have to reset and re-setup your application using the following 2 commands:
```
php artisan sportr:reset
php artisan sportr:setup
```
Make sure you don't rollback your migrations manually to prevent this specific error.

### Cors
If Cors policy blocks XMLHttpRequests from the client-side you might add the following 3 lines to the `bootstrap/app.php` file:
```php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
```
[!!!] This solution should only be used in local development since it could lead to serious security vulnerabilities. To find out more check out [MDN CORS](https://developer.mozilla.org/de/docs/Web/HTTP/CORS).

### Database
If you receive a `SQLSTATE[HY000] [2002]` error while migrating the database you might also have to specify the path to your local MySQL Socket file in the `.env` file:
```
...
DB_SOCKET=/path/to/mysql.sock
...
```