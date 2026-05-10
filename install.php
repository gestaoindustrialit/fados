<?php

require __DIR__ . '/app/Core/Helpers.php';
require __DIR__ . '/app/Core/Database.php';

use App\Core\Database;

try {
    $dbPath = config('db.database');
    $dir = dirname($dbPath);
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    $pdo = Database::connection();
    $schema = file_get_contents(__DIR__ . '/database/schema.sql');
    $seed = file_get_contents(__DIR__ . '/database/seed.sql');

    $pdo->exec($schema);
    $pdo->exec($seed);

    echo "Instalação concluída com sucesso.\n";
    echo "DB SQLite: {$dbPath}\n";
    echo "Admin: admin@admin.com / admin123\n";
} catch (Throwable $e) {
    http_response_code(500);
    echo 'Erro na instalação: ' . $e->getMessage() . "\n";
}
