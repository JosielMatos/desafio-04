<?php
require_once __DIR__ . '/../UserRepository.php';

class AuthController {
    private $repo;

    public function __construct($pdo) {
        $this->repo = new UserRepository($pdo);
    }

    public function registerForm() {
        include __DIR__ . '/../views/register_form.php';
    }

    public function register($data) {
        $username = trim($data['username'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';
        $errors = [];

        if (strlen($username) < 3) {
            $errors[] = "O nome de usuário deve ter pelo menos 3 caracteres.";
        }
        if (strlen($password) < 8) {
            $errors[] = "A senha deve ter pelo menos 8 caracteres.";
        }

        if ($errors) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
            $this->registerForm();
            return;
        }

        if ($this->repo->create($username, $email, $password)) {
            header("Location: login.php");
        } else {
            echo "<div class='alert alert-danger'>Erro ao registrar usuário.</div>";
        }
    }

    public function loginForm() {
        include __DIR__ . '/../views/login_form.php';
    }

    public function login($data) {
        session_start();
        $user = $this->repo->findByEmail($data['email']);

        if ($user && password_verify($data['password'], $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header("Location: index.php?action=list");
        } else {
            echo "<div class='alert alert-danger'>Credenciais inválidas!</div>";
            $this->loginForm();
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
    }
}
