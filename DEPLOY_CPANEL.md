# cPanel Deployment Guide

This Laravel app should be deployed with the project files outside `public_html` and the domain document root pointed at the app's `public` directory.

## Recommended cPanel Layout

- App path: `/home/CPANEL_USER/protiddhoni-cms`
- Domain document root: `/home/CPANEL_USER/protiddhoni-cms/public`
- PHP version: 8.1 or 8.2
- Database: MySQL/MariaDB from cPanel

## Deploy From GitHub

1. In cPanel, open **Git Version Control** and clone the GitHub repository into `/home/CPANEL_USER/protiddhoni-cms`.
2. In **Domains**, set the domain/subdomain document root to `/home/CPANEL_USER/protiddhoni-cms/public`.
3. Create a MySQL database and user in cPanel, then assign the user to the database.
4. Copy `.env.example` to `.env` and update production values:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cpaneluser_database
DB_USERNAME=cpaneluser_dbuser
DB_PASSWORD=strong_password
```

5. Run these commands from the project directory over cPanel Terminal or SSH:

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate --force
php artisan migrate --seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

6. Login to `/admin` with the seeded admin account, then change the password immediately:

```text
Email: admin@protiddhoni-bd.com
Password: change-me-now
```

## If cPanel Cannot Change Document Root

Keep the app in `/home/CPANEL_USER/protiddhoni-cms`, copy only the contents of `public/` into `public_html`, and update `public_html/index.php` paths so they point to the app directory:

```php
require __DIR__.'/../protiddhoni-cms/vendor/autoload.php';
$app = require_once __DIR__.'/../protiddhoni-cms/bootstrap/app.php';
```

Also copy `public/.htaccess` into `public_html/.htaccess`.

## After Each Pull

```bash
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
