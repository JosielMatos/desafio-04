<?php
require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/TaskRepository.php';
require_once __DIR__ . '/../src/controllers/TaskController.php';

$action = $_GET['action'] ?? 'list';

$controller = new TaskController($pdo);

switch ($action) {
    case 'list':
        $controller->list();
        break;
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store($_POST);
        break;
    case 'edit':
        $controller->edit($_GET['id']);
        break;
    case 'update':
        $controller->update($_POST);
        break;
    case 'delete':
        $controller->delete($_GET['id']);
        break;
    case 'show':
        $controller::show($pdo, $_GET['id']);
        break;
    case 'logout':
        session_destroy();
        header("Location: login.php");
        exit;
    default:
        echo "Ação inválida!";
}
