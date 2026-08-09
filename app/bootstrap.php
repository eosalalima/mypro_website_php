<?php
declare(strict_types=1);
$autoload = dirname(__DIR__) . '/vendor/autoload.php';
if (is_file($autoload)) {
    require $autoload;
} else {
    spl_autoload_register(static function (string $class): void {
        $prefix = 'MyPro\\';
        if (!str_starts_with($class, $prefix)) return;
        $file = __DIR__ . '/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
        if (is_file($file)) require $file;
    });
}
require __DIR__.'/helpers.php';
MyPro\Env::load(dirname(__DIR__).'/.env');
date_default_timezone_set(MyPro\Env::get('APP_TIMEZONE','Asia/Manila'));
if (PHP_SAPI !== 'cli') {
    session_name('mypro_session');
    session_set_cookie_params(['httponly'=>true,'secure'=>MyPro\Env::bool('SESSION_SECURE',false),'samesite'=>'Lax','path'=>'/']);
    session_start();
    header('X-Content-Type-Options: nosniff'); header('X-Frame-Options: SAMEORIGIN'); header('Referrer-Policy: strict-origin-when-cross-origin');
}
