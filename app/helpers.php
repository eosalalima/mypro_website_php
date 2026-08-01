<?php
declare(strict_types=1);
use MyPro\Env;
function e(?string $value): string { return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function url(string $path = '/'): string { return rtrim(Env::get('APP_URL', ''), '/') . '/' . ltrim($path, '/'); }
function app_base_path(): string
{
    $configured = trim((string) Env::get('APP_BASE_PATH', ''));
    if ($configured !== '') return '/' . trim($configured, '/');
    $directory = str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/index.php')));
    if (str_ends_with($directory, '/public')) $directory = substr($directory, 0, -7);
    return $directory === '/' || $directory === '.' ? '' : rtrim($directory, '/');
}
function app_path(string $path = '/'): string { return app_base_path() . '/' . ltrim($path, '/'); }
function request_path(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $base = app_base_path();
    if ($base !== '' && ($path === $base || str_starts_with($path, $base . '/'))) $path = substr($path, strlen($base)) ?: '/';
    return '/' . ltrim($path, '/');
}
function csrf_token(): string { if (empty($_SESSION['_token'])) $_SESSION['_token'] = bin2hex(random_bytes(32)); return $_SESSION['_token']; }
function csrf_field(): string { return '<input type="hidden" name="_token" value="'.e(csrf_token()).'">'; }
function verify_csrf(): void { if (!hash_equals($_SESSION['_token'] ?? '', (string)($_POST['_token'] ?? ''))) { http_response_code(419); exit('Your session expired. Please go back and try again.'); } }
function flash(string $key, ?string $value = null): ?string { if ($value !== null) { $_SESSION['_flash'][$key] = $value; return null; } $v=$_SESSION['_flash'][$key]??null; unset($_SESSION['_flash'][$key]); return $v; }
function redirect(string $path): never { header('Location: '.app_path($path), true, 303); exit; }
function old(string $key, string $default=''): string { return e((string)($_SESSION['_old'][$key] ?? $default)); }
