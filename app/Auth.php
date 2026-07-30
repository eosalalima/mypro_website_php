<?php
declare(strict_types=1);
namespace MyPro;
final class Auth
{
    public static function user(): ?array
    {
        if (empty($_SESSION['user_id'])) return null;
        $q=Database::connect()->prepare('SELECT id,name,email,role FROM users WHERE id=?'); $q->execute([$_SESSION['user_id']]);
        return $q->fetch() ?: null;
    }
    public static function attempt(string $email, string $password): bool
    {
        $q=Database::connect()->prepare('SELECT * FROM users WHERE email=? LIMIT 1'); $q->execute([strtolower(trim($email))]); $u=$q->fetch();
        if (!$u || !password_verify($password, $u['password'])) return false;
        session_regenerate_id(true); $_SESSION['user_id']=$u['id']; return true;
    }
    public static function requireAdmin(): array { $u=self::user(); if (!$u || $u['role']!=='admin') redirect('/admin/login'); return $u; }
    public static function logout(): void { unset($_SESSION['user_id']); session_regenerate_id(true); }
}
