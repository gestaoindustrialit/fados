<?php

namespace App\Core;

class Controller
{
    protected function view(string $path, array $data = []): void
    {
        extract($data);
        $view = __DIR__ . '/../Views/' . $path . '.php';
        if (!file_exists($view)) {
            http_response_code(404);
            exit('View not found');
        }
        require __DIR__ . '/../Views/layouts/app.php';
    }
}
