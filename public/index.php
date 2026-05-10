<?php
session_start();
date_default_timezone_set('Europe/Lisbon');

require __DIR__ . '/../app/Core/Helpers.php';
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    if (strpos($class, $prefix) === 0) {
        $path = __DIR__ . '/../app/' . str_replace('App\\', '', $class) . '.php';
        $path = str_replace('\\', '/', $path);
        if (file_exists($path)) require $path;
    }
});

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\ClientController;
use App\Controllers\HomeController;
use App\Core\Router;

$router = new Router();
$router->get('/', [HomeController::class, 'index']);
$router->get('/events', [HomeController::class, 'events']);
$router->get('/event/{id}', [HomeController::class, 'eventDetail']);
$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'registerForm']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/client/dashboard', [ClientController::class, 'dashboard']);
$router->get('/client/reservations', [ClientController::class, 'reservations']);
$router->get('/client/reservations/create/{id}', [ClientController::class, 'create']);
$router->post('/client/reservations/store', [ClientController::class, 'store']);

$router->get('/admin/dashboard', [AdminController::class, 'dashboard']);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
