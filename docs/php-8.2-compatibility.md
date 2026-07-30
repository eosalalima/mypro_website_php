# PHP 8.2.12 Runtime Baseline

## Runtime target

This application targets **PHP 8.2.12**. The Composer root requirement and Composer platform configuration both pin dependency resolution to that version, so dependency updates cannot silently select packages that require a newer PHP runtime.

Laravel 12 supports PHP 8.2, and the application avoids syntax and standard-library features introduced after PHP 8.2. Deploy production and command-line processes with PHP 8.2.12 so web requests, Artisan commands, Composer scripts, queue workers, and scheduled commands all use the same runtime.

## Dependency workflow

Run dependency operations with Composer 2:

```bash
composer install
composer check-platform-reqs
```

Use `composer update` only when intentionally refreshing the lock file. Review the resulting dependency changes and run the full automated test suite afterward. Do not use `--ignore-platform-reqs`; it defeats the runtime guarantee.

## Server verification

Before deployment, verify the active binaries:

```bash
php --version
composer check-platform-reqs
php artisan about
```

On hosts with multiple PHP installations, configure the web server, cron jobs, queue workers, and deployment shell to invoke the PHP 8.2.12 binary explicitly.
