<?php

function config($key, $default = null)
{
    static $config;
    if ($config === null) {
        $config = require __DIR__ . '/../../config/config.php';
    }

    $segments = explode('.', $key);
    $value = $config;
    foreach ($segments as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return $default;
        }
        $value = $value[$segment];
    }

    return $value;
}

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect($path)
{
    header('Location: ' . $path);
    exit;
}

function old($key, $default = '')
{
    return isset($_SESSION['_old'][$key]) ? $_SESSION['_old'][$key] : $default;
}

function flash($key, $message = null)
{
    if ($message !== null) {
        $_SESSION['_flash'][$key] = $message;
        return null;
    }
    $msg = isset($_SESSION['_flash'][$key]) ? $_SESSION['_flash'][$key] : null;
    unset($_SESSION['_flash'][$key]);
    return $msg;
}

function csrf_token()
{
    if (empty($_SESSION['_csrf'])) {
        $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf'];
}

function verify_csrf()
{
    $token = isset($_POST['_csrf']) ? $_POST['_csrf'] : '';
    $sessionToken = isset($_SESSION['_csrf']) ? $_SESSION['_csrf'] : '';
    if (!hash_equals($sessionToken, $token)) {
        http_response_code(419);
        exit('Invalid CSRF token');
    }
}
