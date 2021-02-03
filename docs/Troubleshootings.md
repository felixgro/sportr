## Troubleshootings
List of common problems along with instructions how to fix and prevent them.

No solution for your problem? Feel free to send an email to [me@felixgrohs.at](mailto:me@felixgrohs.at) and I'll be happy helping out.

### Public storage
If you receive a `404 Not Found Error` when requesting sport icons from the client-side you might have to reset and re-setup your application using the following 2 commands:
```
php artisan sportr:reset
php artisan sportr:setup
```
Make sure you don't rollback your migrations manually to prevent this specific error.

### Database
If you receive a `SQLSTATE[HY000] [2002]` error while migrating the database you might also have to specify the path to your local MySQL Socket file in the `.env` file:
```
...
DB_SOCKET=/path/to/mysql.sock
...
```