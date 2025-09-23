<?php
require_once __DIR__ . '/../TaskRepository.php';

class TaskController {
    private $repo;
    private $userId;

    public function __construct($pdo) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit;
        }

        $this->repo = new TaskRepository($pdo);
        $this->userId = $_SESSION['user_id'];
    }

    public function list() {
        $order = $_GET['order'] ?? null;
        $dir = $_GET['dir'] ?? 'asc';
        $tasks = $this->repo->getAllByUser($this->userId, $order, $dir);
        include __DIR__ . '/../views/tasks_list.php';
    }

    public function create() {
        include __DIR__ . '/../views/task_form.php';
    }

    public function store($data) {
        $this->repo->create($data, $this->userId);
        header("Location: index.php?action=list");
    }

    public function edit($id) {
    $task = $this->repo->find($id, $this->userId);

    if (!$task) {
        $error = "Tarefa não encontrada ou você não tem permissão para acessá-la.";
        include __DIR__ . '/../views/error.php';
        return;
    }

        include __DIR__ . '/../views/task_form.php';
    }

    public function update($data) {
        $this->repo->update($data, $this->userId);
        header("Location: index.php?action=list");
    }

    public function delete($id) {
    $task = $this->repo->find($id, $this->userId);

    if (!$task) {
        $error = "Tarefa não encontrada ou você não tem permissão para excluí-la.";
        include __DIR__ . '/../views/error.php';
        return;
    }

        $this->repo->delete($id, $this->userId);
        header("Location: index.php?action=list");
    }

    public static function show($pdo, $id) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $_SESSION['user_id']]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$task) {
            echo "<div class='alert alert-danger'>Tarefa não encontrada.</div>";
            echo "<a href='index.php?action=list' class='btn btn-secondary'>Voltar</a>";
            return;
        }

        include __DIR__ . '/../views/task_show.php';
    }
}
