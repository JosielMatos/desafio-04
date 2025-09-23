<?php
require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';

$controller = new AuthController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->register($_POST);
} else {
    $controller->registerForm();
}
