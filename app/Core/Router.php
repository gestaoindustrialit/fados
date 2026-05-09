<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void { $this->add('GET', $path, $handler); }
    public function post(string $path, array $handler): void { $this->add('POST', $path, $handler); }

    private function add(string $method, string $path, array $handler): void
    {
        $pattern = preg_replace('/\{[a-z_]+\}/', '([0-9]+)', $path);
        $pattern = '#^' . $pattern . '$#';
        $this->routes[$method][] = ['pattern' => $pattern, 'handler' => $handler];
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH);
        foreach ($this->routes[$method] ?? [] as $route) {
            if (preg_match($route['pattern'], $path, $matches)) {
                array_shift($matches);
                [$class, $action] = $route['handler'];
                (new $class())->$action(...$matches);
                return;
            }
        }
        http_response_code(404);
        echo 'Página não encontrada';
    }
}
