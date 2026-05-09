<?php

namespace App\Core;

use App\Models\User;

class Auth
{
    public static function user(): ?array
    {
        if (empty($_SESSION['user_id'])) {
            return null;
        }
        return (new User())->find((int) $_SESSION['user_id']);
    }

    public static function attempt(string $email, string $password): bool
    {
        $user = (new User())->findByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }
        $_SESSION['user_id'] = $user['id'];
        return true;
    }

    public static function logout(): void
    {
        unset($_SESSION['user_id']);
        session_regenerate_id(true);
    }

    public static function requireRole(string $role): void
    {
        $user = self::user();
        if (!$user || $user['role'] !== $role) {
            redirect('/login');
        }
    }

    public static function requireAuth(): void
    {
        if (!self::user()) {
            redirect('/login');
        }
    }
}
