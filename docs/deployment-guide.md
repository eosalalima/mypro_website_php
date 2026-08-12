# cPanel deployment guide

## Readiness assessment

The application is suitable for ordinary Apache-based cPanel hosting: it is server-rendered PHP, has no Node.js build, has no third-party runtime packages, supports MySQL/MariaDB, and includes Apache rewrite rules. It does, however, require control of the domain's document root, PHP 8.2 or newer, PDO MySQL, writable private storage, and CLI access for installation. Confirm those features with the hosting provider before changing DNS.

Do not launch with the bundled sample project or testimonial presented as real client work. Review the legal copy, partner marks, company contact details, inquiry retention policy, and email delivery with the site owner first.

## Recommended directory layout

Keep the application outside `public_html` and expose only `public/`:

```text
/home/CPANEL_USER/mypro_website_php/       private application directory
/home/CPANEL_USER/mypro_website_php/.env  private production secrets
/home/CPANEL_USER/mypro_website_php/public/  domain document root
```

In **Domains** (or **Addon Domains**) set the domain document root to `/home/CPANEL_USER/mypro_website_php/public`. Never point it at the repository root: doing so could expose `.env`, `storage`, scripts, and source files. If the hosting plan will only serve `public_html` and will not allow its document root to change, ask the provider to change it or deploy with a carefully maintained `public_html/index.php` bridge; copying the whole repository into `public_html` is not safe.

## One-time deployment

1. In **MultiPHP Manager**, select PHP 8.2 or a newer compatible release. In **Select PHP Version**, enable `pdo`, `pdo_mysql`, and `mbstring`.
2. In **MySQL Databases**, create a database and a dedicated user, add the user to the database with the required privileges, and retain the cPanel-prefixed names (for example, `account_mypro`). Do not use the MySQL `root` user.
3. Upload or clone the repository into the private directory. If using **Git Version Control**, edit `APP_DEPLOYPATH` in `.cpanel.yml` for the account before running **Deploy HEAD Commit**. The deployment recipe preserves `.env` and `storage`, optionally installs Composer's autoloader, initializes the schema, and runs the readiness check.
4. Copy `.env.example` to `.env` in the private directory and use production values:

   ```dotenv
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://www.example.com
   APP_TIMEZONE=Asia/Manila
   APP_KEY=PASTE_AT_LEAST_64_RANDOM_CHARACTERS_HERE
   DB_DSN="mysql:host=localhost;port=3306;dbname=account_mypro;charset=utf8mb4"
   DB_USERNAME=account_myprouser
   DB_PASSWORD=PASTE_A_STRONG_DATABASE_PASSWORD
   ADMIN_NAME=MyPro Administrator
   ADMIN_EMAIL=admin@example.com
   ADMIN_PASSWORD=PASTE_A_UNIQUE_12_PLUS_CHARACTER_PASSWORD
   MAIL_FROM_ADDRESS=website@example.com
   INQUIRY_NOTIFICATION_EMAIL=sales@example.com
   SESSION_SECURE=true
   CONTENT_CACHE_TTL=300
   ```

   Generate `APP_KEY` in cPanel Terminal with `php -r "echo bin2hex(random_bytes(32)), PHP_EOL;"`. Quote values containing spaces, `#`, or other punctuation.
5. From cPanel Terminal, initialize and verify the site:

   ```bash
   cd "$HOME/mypro_website_php"
   php scripts/install.php
   php scripts/create-admin.php   # use this if install.php did not create the account
   php scripts/cpanel-check.php
   ```

6. Immediately remove `ADMIN_PASSWORD` from `.env` after the admin exists. Keep `.env` readable only by the account, and make `storage/cache`, `storage/logs`, and `storage/uploads` writable by the PHP process. Avoid world-writable `0777` permissions.
7. Enable a valid TLS certificate in **SSL/TLS Status**, redirect HTTP to HTTPS at the cPanel/domain level, and then verify `/`, `/contact`, `/admin/login`, a nonexistent URL, CSS/images, and a real inquiry submission.

Composer is optional because the project includes a first-party PSR-4 autoloader and has no external runtime dependencies. If available, run `composer install --no-dev --classmap-authoritative --no-interaction` in the private directory.

## Mail, jobs, and PHP settings

The contact form stores an inquiry before attempting PHP `mail()`, so a mail failure does not discard the database record. Nevertheless, ask the host to configure authenticated outbound mail and SPF/DKIM/DMARC, then test delivery and spam placement. Set `display_errors=Off`, log PHP errors to a private file, set a suitable log rotation policy, and do not expose logs under the document root.

No cron job is required. If one is later added for backups or retention, use the cPanel-selected PHP binary and keep its output private.

## Release and rollback checklist

Before each release, back up the database, `.env`, and uploaded files; test restoration separately; run `composer check` and `composer test`; and deploy during a low-traffic window. After deployment, rerun `php scripts/cpanel-check.php` and smoke-test public and admin routes. Retain the previous known-good commit so application files can be rolled back, but never roll back the database without a tested backup and an explicit migration plan.
