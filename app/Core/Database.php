<?php

namespace App\Core;

use PDO;

class Database
{
    private static $pdo = null;

    public static function connection()
    {
        if (self::$pdo === null) {
            $driver = config('db.driver', 'sqlite');

            if ($driver === 'sqlite') {
                $dbPath = config('db.database');
                if (!file_exists($dbPath)) {
                    touch($dbPath);
                }
                self::$pdo = new PDO('sqlite:' . $dbPath);
            } else {
                $dsn = sprintf(
                    'mysql:host=%s;port=%d;dbname=%s;charset=%s',
                    config('db.host'),
                    config('db.port'),
                    config('db.database'),
                    config('db.charset', 'utf8mb4')
                );
                self::$pdo = new PDO($dsn, config('db.username'), config('db.password'));
            }

            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return self::$pdo;
    }
}
