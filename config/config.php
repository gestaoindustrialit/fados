<?php
return [
    'app' => [
        'name' => 'Gestão de Reservas para Eventos',
        'url' => 'http://localhost',
        'timezone' => 'Europe/Lisbon',
        'debug' => true,
    ],
    'db' => [
        'host' => '127.0.0.1',
        'port' => 3306,
        'database' => 'fados',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4',
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
