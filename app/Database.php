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
        self::$pdo = new PDO(Env::get('DB_DSN', $default), Env::get('DB_USERNAME', ''), Env::get('DB_PASSWORD', ''), [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        if (str_starts_with((string) Env::get('DB_DSN', $default), 'sqlite:')) self::$pdo->exec('PRAGMA foreign_keys = ON');
        return self::$pdo;
    }
    public static function reset(?PDO $pdo = null): void { self::$pdo = $pdo; }
}
