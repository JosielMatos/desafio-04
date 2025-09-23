<?php
$dsn = "mysql:host=db;dbname=todo_db;charset=utf8mb4";
$user = "todo_user";
$pass = "todo_password";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
