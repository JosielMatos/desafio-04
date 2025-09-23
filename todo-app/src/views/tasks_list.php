<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Tarefas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <?php include __DIR__ . '/partials/navbar.php'; ?>

    <?php
    $currentOrder = $_GET['order'] ?? 'created_at';
    $currentDir = $_GET['dir'] ?? 'asc';
    $nextDir = ($currentDir === 'asc') ? 'desc' : 'asc';
    ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Minhas Tarefas</h1>
        <div class="d-flex flex-column flex-md-row gap-2">
            <a href="index.php?action=create" class="btn btn-success">➕ Nova Tarefa</a>
            <a href="index.php?action=list&order=created_at&dir=<?= ($currentOrder === 'created_at' ? $nextDir : 'asc') ?>" class="btn btn-secondary">
                Ordenar por Criação <?= $currentOrder === 'created_at' ? ($currentDir === 'asc' ? '↑' : '↓') : '' ?>
            </a>
            <a href="index.php?action=list&order=status&dir=<?= ($currentOrder === 'status' ? $nextDir : 'asc') ?>" class="btn btn-secondary">
                Ordenar por Status <?= $currentOrder === 'status' ? ($currentDir === 'asc' ? '↑' : '↓') : '' ?>
            </a>
        </div>
    </div>

    <?php if (!empty($tasks)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Status</th>
                    <th class="d-none d-md-table-cell">Prioridade</th>
                    <th>Data de Entrega</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['title']) ?></td>
                        <td>
                            <?php
                            $statusLabels = [
                                'pending' => "<span class='badge bg-secondary'>Pendente</span>",
                                'in_progress' => "<span class='badge bg-primary'>Em andamento</span>",
                                'done' => "<span class='badge bg-success'>Concluída</span>"
                            ];
                            echo $statusLabels[$task['status']] ?? $task['status'];
                            ?>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <?php
                            $priorityLabels = [
                                'low' => 'Baixa',
                                'medium' => 'Média',
                                'high' => 'Alta'
                            ];
                            echo $priorityLabels[$task['priority']] ?? $task['priority'];
                            ?>
                        </td>
                        <td><?= $task['due_at'] ? date('d/m/Y H:i', strtotime($task['due_at'])) : '-' ?></td>
                        <td>
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <a href="index.php?action=show&id=<?= $task['id'] ?>" class="btn btn-sm btn-primary w-100">Ver</a>
                                <a href="index.php?action=edit&id=<?= $task['id'] ?>" class="btn btn-sm btn-warning w-100">Editar</a>
                                <a href="index.php?action=delete&id=<?= $task['id'] ?>" 
                                class="btn btn-sm btn-danger w-100"
                                onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">Excluir</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Nenhuma tarefa encontrada. Crie uma nova!</div>
    <?php endif; ?>

    <!-- Bootstrap JS Bundle (inclui Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
