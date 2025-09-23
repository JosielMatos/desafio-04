<?php
require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';

$controller = new AuthController($pdo);
$controller->logout();
