# Deployment Guide

## Runtime requirements

- PHP 8.2.12 with the extensions reported by `composer check-platform-reqs`
- Composer 2
- MySQL 8 or MariaDB 10.6+
- Node.js 20+ for building Vite assets (or prebuilt assets from the same commit)
- A web server whose document root points to Laravel's `public` directory

The application pins Composer dependency resolution to PHP 8.2.12. Do not bypass that check with `--ignore-platform-reqs`.

## Recommended deployment

1. Deploy the application outside the public web root and point the domain document root to `APPLICATION/public`.
2. Run `composer install --no-dev --optimize-autoloader`.
3. Run `npm ci && npm run build`, or upload CI-built `public/build` assets.
4. Create `.env`, configure production secrets, and set `APP_DEBUG=false` and the canonical `APP_URL`.
5. Run `php artisan migrate --force` after taking a database backup.
6. Run `php artisan storage:link` and make `storage` and `bootstrap/cache` writable by the application user.
7. Run `php artisan optimize`.
8. Configure HTTPS, secure cookies, backups, log rotation, and a supervised queue worker if mail is queued.

## Restricted cPanel deployment

Keep the complete application above `public_html`. Copy only the contents of Laravel's `public` directory into `public_html`, and change the bootstrap and autoload paths in the exposed `index.php` to the private application directory. Never expose `.env`, application source, Composer metadata, or storage logs. Select PHP 8.2.12 for both the domain and cron/terminal commands. Build assets before upload if Node.js is unavailable.

## Production configuration

Configure database credentials, `APP_KEY`, authenticated SMTP, `INQUIRY_NOTIFICATION_EMAIL`, session and cache drivers, and the public filesystem. Run `php artisan schedule:run` every minute only when scheduled tasks are introduced. Back up both the database and `storage/app/public`, and test restoration regularly.

## Verification

```bash
php --version
composer check-platform-reqs
php artisan migrate:status
php artisan about
```
