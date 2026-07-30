<?php
declare(strict_types=1);
namespace MyPro;
final class Content
{
    public static function published(string $type, ?int $limit=null): array
    { $sql='SELECT * FROM contents WHERE type=? AND status=\'published\' AND (published_at IS NULL OR published_at<=CURRENT_TIMESTAMP) ORDER BY sort_order,title'.($limit?' LIMIT '.(int)$limit:''); $q=Database::connect()->prepare($sql); $q->execute([$type]); return $q->fetchAll(); }
    public static function find(string $type,string $slug): ?array
    { $q=Database::connect()->prepare("SELECT * FROM contents WHERE type=? AND slug=? AND status='published' LIMIT 1"); $q->execute([$type,$slug]); return $q->fetch()?:null; }
    public static function settings(): array
    { try { return Database::connect()->query('SELECT name,value FROM settings')->fetchAll(\PDO::FETCH_KEY_PAIR); } catch (\Throwable) { return []; } }
}
