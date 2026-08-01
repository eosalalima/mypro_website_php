<?php
declare(strict_types=1);
namespace MyPro;
use PDO;
final class Database
{
    private static ?PDO $pdo = null;
    public static function connect(): PDO
    {
        if (self::$pdo) return self::$pdo;
        $default = 'sqlite:' . dirname(__DIR__) . '/storage/mypro.sqlite';
        $dsn = (string) Env::get('DB_DSN', $default);
        $dsn = self::normalizeSqliteDsn($dsn);
        self::$pdo = new PDO($dsn, Env::get('DB_USERNAME', ''), Env::get('DB_PASSWORD', ''), [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        if (str_starts_with($dsn, 'sqlite:')) self::$pdo->exec('PRAGMA foreign_keys = ON');
        return self::$pdo;
    }
    private static function normalizeSqliteDsn(string $dsn): string
    {
        if (!str_starts_with($dsn, 'sqlite:')) return $dsn;
        $path = substr($dsn, 7);
        if ($path === ':memory:' || $path === '' || str_starts_with($path, '/') || preg_match('/^[A-Za-z]:[\\\\\/]/', $path)) return $dsn;
        return 'sqlite:' . dirname(__DIR__) . '/' . str_replace('\\', '/', $path);
    }
    public static function reset(?PDO $pdo = null): void { self::$pdo = $pdo; }
}
