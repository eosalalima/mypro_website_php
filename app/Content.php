<?php

declare(strict_types=1);

namespace MyPro;

use PDO;
use Throwable;

final class Content
{
    private const DEFAULT_CACHE_TTL = 300;

    /** @var array<string, array> */
    private static array $requestCache = [];

    public static function published(string $type, ?int $limit = null): array
    {
        $key = 'published-' . hash('sha256', $type . ':' . ($limit ?? 'all'));

        return self::remember($key, static function () use ($type, $limit): array {
            $sql = "SELECT * FROM contents WHERE type=? AND status='published' AND (published_at IS NULL OR published_at<=CURRENT_TIMESTAMP) ORDER BY sort_order,title";
            if ($limit !== null) {
                $sql .= ' LIMIT ' . max(0, $limit);
            }
            $query = Database::connect()->prepare($sql);
            $query->execute([$type]);

            return $query->fetchAll();
        });
    }

    public static function find(string $type, string $slug): ?array
    {
        $key = 'item-' . hash('sha256', $type . ':' . $slug);
        $item = self::remember($key, static function () use ($type, $slug): array {
            $query = Database::connect()->prepare("SELECT * FROM contents WHERE type=? AND slug=? AND status='published' LIMIT 1");
            $query->execute([$type, $slug]);

            return $query->fetch() ?: [];
        });

        return $item ?: null;
    }

    public static function settings(): array
    {
        try {
            return self::remember('settings', static fn (): array => Database::connect()
                ->query('SELECT name,value FROM settings')
                ->fetchAll(PDO::FETCH_KEY_PAIR));
        } catch (Throwable) {
            return [];
        }
    }

    /** Remove public-data caches after a CMS write so the next request sees it. */
    public static function clearCache(): void
    {
        self::$requestCache = [];
        $files = glob(self::cacheDirectory() . '/' . self::namespace() . '-*.json') ?: [];
        foreach ($files as $file) {
            @unlink($file);
        }
    }

    private static function remember(string $key, callable $load): array
    {
        $memoryKey = self::namespace() . ':' . $key;
        if (array_key_exists($memoryKey, self::$requestCache)) {
            return self::$requestCache[$memoryKey];
        }

        $file = self::cacheDirectory() . '/' . self::namespace() . '-' . $key . '.json';
        $ttl = max(0, (int) Env::get('CONTENT_CACHE_TTL', (string) self::DEFAULT_CACHE_TTL));
        if ($ttl > 0 && is_file($file) && filemtime($file) >= time() - $ttl) {
            $cached = json_decode((string) file_get_contents($file), true);
            if (is_array($cached)) {
                return self::$requestCache[$memoryKey] = $cached;
            }
        }

        $value = $load();
        self::$requestCache[$memoryKey] = $value;
        if ($ttl > 0) {
            self::writeCache($file, $value);
        }

        return $value;
    }

    private static function writeCache(string $file, array $value): void
    {
        $directory = dirname($file);
        if (!is_dir($directory) && !@mkdir($directory, 0775, true) && !is_dir($directory)) {
            return;
        }
        $temporary = tempnam($directory, 'content-');
        if ($temporary === false) {
            return;
        }
        $json = json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($json === false || file_put_contents($temporary, $json, LOCK_EX) === false || !@rename($temporary, $file)) {
            @unlink($temporary);
        }
    }

    private static function cacheDirectory(): string
    {
        return dirname(__DIR__) . '/storage/cache';
    }

    private static function namespace(): string
    {
        return substr(hash('sha256', (string) Env::get('DB_DSN', 'sqlite:storage/mypro.sqlite')), 0, 16);
    }
}
