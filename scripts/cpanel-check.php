<?php

declare(strict_types=1);

require dirname(__DIR__) . '/app/bootstrap.php';

use MyPro\Database;
use MyPro\Env;

$errors = [];
$warnings = [];
$root = dirname(__DIR__);

if (PHP_VERSION_ID < 80200) {
    $errors[] = 'Select PHP 8.2 or newer in cPanel MultiPHP Manager.';
}

foreach (['pdo', 'mbstring'] as $extension) {
    if (!extension_loaded($extension)) {
        $errors[] = "Enable the PHP {$extension} extension in cPanel.";
    }
}

$dsn = Env::get('DB_DSN', '') ?? '';
if ($dsn === '') {
    $errors[] = 'DB_DSN is not configured in .env.';
} elseif (str_starts_with($dsn, 'mysql:') && !extension_loaded('pdo_mysql')) {
    $errors[] = 'Enable pdo_mysql for the configured MySQL/MariaDB database.';
} elseif (str_starts_with($dsn, 'sqlite:') && !extension_loaded('pdo_sqlite')) {
    $errors[] = 'Enable pdo_sqlite for the configured SQLite database.';
}

if (!is_file($root . '/.env')) {
    $errors[] = 'Create the private .env file before deploying.';
}

foreach (['storage', 'storage/cache', 'storage/logs', 'storage/uploads'] as $directory) {
    $path = $root . '/' . $directory;
    if (!is_dir($path) || !is_writable($path)) {
        $errors[] = "{$directory}/ must exist and be writable by PHP.";
    }
}

if (Env::bool('APP_DEBUG', false)) {
    $warnings[] = 'APP_DEBUG is enabled; set APP_DEBUG=false for production.';
}
if ((Env::get('APP_ENV', '') ?? '') !== 'production') {
    $warnings[] = 'APP_ENV should be set to production.';
}
if (filter_var(ini_get('display_errors'), FILTER_VALIDATE_BOOLEAN)) {
    $warnings[] = 'PHP display_errors is enabled; disable it and log errors privately in production.';
}
if (!Env::bool('SESSION_SECURE', false)) {
    $warnings[] = 'SESSION_SECURE is disabled; enable it after HTTPS is active.';
}
if (!str_starts_with(Env::get('APP_URL', '') ?? '', 'https://')) {
    $warnings[] = 'APP_URL should use the production HTTPS address.';
}
if (strlen(Env::get('APP_KEY', '') ?? '') < 64) {
    $warnings[] = 'APP_KEY should contain at least 64 random characters.';
}

try {
    Database::connect()->query('SELECT 1');
} catch (Throwable $exception) {
    $errors[] = 'Database connection failed: ' . $exception->getMessage();
}

foreach ($warnings as $warning) {
    fwrite(STDERR, "WARNING: {$warning}\n");
}

if ($errors !== []) {
    foreach ($errors as $error) {
        fwrite(STDERR, "ERROR: {$error}\n");
    }
    exit(1);
}

echo 'cPanel readiness check passed on PHP ' . PHP_VERSION . ".\n";
