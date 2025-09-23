<?php

class TaskRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllByUser($userId, $order = null, $dir = 'asc') {
        $allowedOrders = ['created_at', 'status'];
        $allowedDirs = ['asc', 'desc'];
        $orderBy = in_array($order, $allowedOrders) ? $order : 'created_at';
        $direction = in_array(strtolower($dir), $allowedDirs) ? strtoupper($dir) : 'ASC';
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY $orderBy $direction");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id, $userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data, $userId) {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (title, description, status, priority, due_at, user_id) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['status'],
            $data['priority'],
            $data['due_at'] ?: null,
            $userId
        ]);
    }

    public function update($data, $userId) {
        $stmt = $this->pdo->prepare("UPDATE tasks SET title=?, description=?, status=?, priority=?, due_at=?, updated_at=NOW() WHERE id=? AND user_id=?");
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['status'],
            $data['priority'],
            $data['due_at'] ?: null,
            $data['id'],
            $userId
        ]);
    }

    public function delete($id, $userId) {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $userId]);
    }
}
