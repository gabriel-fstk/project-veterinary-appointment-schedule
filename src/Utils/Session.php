<?php
namespace App\Utils;

class Session {
    public static function start(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $key, mixed $value): void {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key): mixed {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    public static function destroy(): void {
        self::start();
        session_destroy();
    }

    public static function isLoggedIn(): bool {
        self::start();
        return isset($_SESSION['user_id']);
    }
}