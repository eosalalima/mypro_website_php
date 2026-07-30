# MyPro Corporate Website and CMS

Production-oriented corporate website for **Myprofessional Solutions, Inc.**, built as a single Laravel 12 application with Vue 3, TypeScript, Inertia.js, Vite, and Tailwind CSS.

## Features

- Responsive public pages for Home, About, Services, Solutions, Industries, Projects, Contact, Privacy, and Terms.
- Five portfolio-verified service areas with searchable, publishable CMS content.
- Secure `/admin` portal with dashboard, content CRUD, publishing states, image uploads, and inquiry status management. Public registration is disabled.
- Validated and rate-limited inquiry workflow with a honeypot, database storage, team notification, and sender confirmation.
- Dynamic titles and descriptions, canonical URL, XML sitemap, robots rules, semantic markup, keyboard focus, reduced-motion support, and accessible controls.
- Centralized contact settings and environment-created initial administrator.

## Requirements

PHP 8.3+, Composer 2, Node.js 20+, npm, and MySQL 8/MariaDB 10.6+ (SQLite is supported locally).

## Local installation

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm install
npm run build
php artisan storage:link
php artisan serve
```

Set `ADMIN_NAME`, `ADMIN_EMAIL`, and a strong `ADMIN_PASSWORD` **before** seeding. The seeder only creates an administrator when email and password are supplied. Re-run `php artisan db:seed` after adding them. Never commit `.env`.

## Environment and production configuration

- Application: `APP_ENV`, `APP_KEY`, `APP_URL`, `APP_DEBUG=false`, `APP_TIMEZONE=Asia/Manila`
- Database: `DB_CONNECTION=mysql`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- Admin bootstrap: `ADMIN_NAME`, `ADMIN_EMAIL`, `ADMIN_PASSWORD`
- Email: `MAIL_MAILER=smtp`, host, port, credentials, encryption, and from address
- Notifications: `INQUIRY_NOTIFICATION_EMAIL`
- Sessions/queues: use database, Redis, or another production-ready shared driver

The development default is the log mailer. Configure authenticated SMTP before launch. Uploaded files use the `public` filesystem; create the link with `php artisan storage:link` and back up both the database and `storage/app/public`.

## Development and quality commands

```bash
php artisan migrate:fresh --seed
php artisan test
vendor/bin/pint --test
npm run lint
npm run build
```

## Content management

Visit `/admin/login`. Content can be drafted, published, archived, ordered, featured, assigned SEO fields, and supplied with a validated image. Projects seeded with “Sample” in the title are demonstrations—not verified client work—and must be replaced or approved before launch. Administrators can triage inquiries as new, in progress, resolved, or spam.

## Deployment

### Recommended server

1. Deploy the application outside the web root and point the domain document root to `APPLICATION/public`.
2. Install production dependencies with `composer install --no-dev --optimize-autoloader` and build assets with `npm ci && npm run build` (or upload prebuilt `public/build`).
3. Configure `.env`, run `php artisan migrate --force`, link storage, and make `storage` and `bootstrap/cache` writable.
4. Run `php artisan optimize`; configure HTTPS, secure cookies, daily backups, log rotation, and a queue worker if asynchronous mail is enabled.

### Restricted cPanel

Keep the Laravel application above `public_html`. Copy only the contents of Laravel's `public` directory into `public_html`, then adjust the two paths in the exposed `index.php` to the private application directory. Never copy `.env`, `vendor` source listings, storage logs, or application code into the public directory. Build locally when Node is unavailable on the host. Configure a cron entry for `php artisan schedule:run` only if scheduled tasks are added.

## Security and maintenance

Use HTTPS, `APP_DEBUG=false`, secure session cookies, unique administrator credentials, least-privilege database access, and a tested backup/restore process. Apply Composer/npm security updates regularly, review inquiry retention, validate legal copy, replace demonstration content, and verify contact/partner data before launch.
