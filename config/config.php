<?php
return [
    'app' => [
        'name' => 'Gestão de Reservas para Eventos',
        'url' => 'http://localhost',
        'timezone' => 'Europe/Lisbon',
        'debug' => true,
    ],
    'db' => [
        'driver' => 'sqlite',
        'database' => __DIR__ . '/../storage/database.sqlite',
    ],
    'smtp' => [
        'host' => 'smtp.example.com',
        'port' => 587,
        'user' => 'user@example.com',
        'pass' => 'secret',
        'from_email' => 'noreply@example.com',
        'from_name' => 'Reservas Eventos',
        'secure' => 'tls',
    ],
];
