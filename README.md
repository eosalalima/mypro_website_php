# MyPro Corporate Website — Vanilla PHP 8.2.12

A responsive corporate website and secure content-management system for **Myprofessional Solutions, Inc.**, implemented in plain, framework-free PHP 8.2.12. The application uses a small front controller, server-rendered semantic HTML, PDO, vanilla JavaScript, and custom CSS. It does **not** require Laravel, Vue, Node.js, or a frontend build step.

## Included functionality

- Public Home, About, Services, Service Details, Solutions, Industries, sample Case Studies, Contact, Privacy, Terms, and custom 404 pages.
- Portfolio-derived descriptions for five core services, capabilities, markets, partner/product contexts, tagline, and contact information.
- Secure `/admin` login with content create/edit/publish/archive/delete workflows and inquiry triage.
- Contact form with server validation, CSRF token, honeypot, 30-second session throttle, consent, database storage, IP hashing, and best-effort email notification.
- SEO titles/descriptions, canonical and Open Graph tags, organization structured data, sitemap, robots policy, semantic landmarks, skip link, visible focus styles, mobile navigation, and reduced-motion support.
- Cookie notice using local browser storage. No analytics or nonessential cookies are installed.

Unverified project and testimonial records are prominently marked **Sample** and must be replaced or approved before launch.

## Requirements

- PHP **8.2.12** with PDO and the PDO driver for SQLite or MySQL/MariaDB
- Composer 2 (autoload generation only; there are no third-party runtime packages)
- Apache with `mod_rewrite`, Nginx, or another server configured to route unknown paths to `public/index.php`

## Local installation

```bash
composer install
cp .env.example .env
# For local SQLite, set DB_DSN=sqlite:/absolute/path/to/storage/mypro.sqlite
php scripts/install.php
php scripts/create-admin.php
php -S 127.0.0.1:8080 -t public public/router.php
```

Before `create-admin.php`, populate `ADMIN_EMAIL` and an `ADMIN_PASSWORD` of at least 12 characters. The installer may also create the initial admin when those variables are already set. No public registration route exists.

## Configuration

| Variable | Purpose |
|---|---|
| `APP_ENV`, `APP_DEBUG`, `APP_URL`, `APP_TIMEZONE` | Runtime behavior and canonical URLs |
| `APP_KEY` | Random application secret used when hashing security metadata |
| `DB_DSN`, `DB_USERNAME`, `DB_PASSWORD` | PDO connection; use a MySQL DSN in production |
| `ADMIN_NAME`, `ADMIN_EMAIL`, `ADMIN_PASSWORD` | Initial admin provisioned by the CLI only |
| `MAIL_FROM_ADDRESS`, `INQUIRY_NOTIFICATION_EMAIL` | Inquiry notification delivery |
| `SESSION_SECURE` | Set `true` when production uses HTTPS |

PHP's `mail()` transport must be configured on the host for notifications. Inquiry storage succeeds even when a development machine has no mail transport. Use an authenticated relay at the server level for reliable production delivery.

## Quality commands

```bash
composer check       # syntax-check every project PHP file
composer test        # focused application/security/content tests
php scripts/install.php
```

There is no asset compilation, npm install, or JavaScript dependency audit because the frontend is vanilla CSS and JavaScript.

## CMS guide

1. Sign in at `/admin/login` with the CLI-created administrator.
2. The dashboard summarizes content and recent inquiries.
3. Under **Content**, select a content type. Add or expand an item, edit its copy/SEO fields/order, choose draft/published/archived, and save.
4. Under **Inquiries**, review messages and change status to new, in progress, resolved, or spam.
5. Database-level settings hold verified company contacts. Update settings with an authenticated database administration tool and keep backups.

Uploaded media is intentionally not enabled in this framework-free baseline. Put optimized WebP/AVIF assets in `public/assets`, then reference them in approved templates; validate content type and randomize names if an upload workflow is later enabled.

## Production deployment

### Standard server or cPanel

1. Keep the repository outside the public web root and point the domain document root to its `public/` directory. On restricted cPanel, expose only the contents of `public/` and adjust the `dirname(__DIR__)` application path in `index.php` to the private repository.
2. Run `composer install --no-dev --classmap-authoritative` in the private application directory.
3. Create `.env` outside source control, set a MySQL DSN, a random 64+ character `APP_KEY`, `APP_DEBUG=false`, the production HTTPS URL, and `SESSION_SECURE=true`.
4. Run `php scripts/install.php`, then `php scripts/create-admin.php`. Remove `ADMIN_PASSWORD` from `.env` after provisioning.
5. Ensure `storage/` is writable by PHP but not publicly accessible. Configure Apache rewrites from `public/.htaccess` or the equivalent Nginx `try_files $uri $uri/ /index.php?$query_string` rule.
6. Enforce HTTPS, security headers, PHP error logging, least-privilege database credentials, and a supported PHP 8.2 patch stream. Configure the host mail transport.

### Operations

Back up the database and `.env` securely, test restoration, rotate admin credentials, monitor error/mail logs, review inquiry retention, keep PHP patched, and periodically run `composer check` and `composer test`. Validate all legal copy, sample content, partner presentation, and contact details with MyPro before launch.

## Architecture

See [`docs/architecture-overview.md`](docs/architecture-overview.md), [`docs/database-mapping.md`](docs/database-mapping.md), and [`docs/deployment-guide.md`](docs/deployment-guide.md) for the framework-free design, schema, and hosting details.
