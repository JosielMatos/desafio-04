<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes da Tarefa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <?php include __DIR__ . '/partials/navbar.php'; ?>

    <h1>📌 Detalhes da Tarefa</h1>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <h4 class="card-title"><?= htmlspecialchars($task['title']) ?></h4>
            <p class="card-text"><?= nl2br(htmlspecialchars($task['description'])) ?></p>

            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item">
                    <strong>Status:</strong>
                    <?php
                    $statusLabels = [
                        'pending' => 'Pendente',
                        'in_progress' => 'Em andamento',
                        'done' => 'Concluída'
                    ];
                    echo $statusLabels[$task['status']] ?? $task['status'];
                    ?>
                </li>
                <li class="list-group-item">
                    <strong>Prioridade:</strong>
                    <?php
                    $priorityLabels = [
                        'low' => 'Baixa',
                        'medium' => 'Média',
                        'high' => 'Alta'
                    ];
                    echo $priorityLabels[$task['priority']] ?? $task['priority'];
                    ?>
                </li>
                <li class="list-group-item">
                    <strong>Data de Entrega:</strong>
                    <?= $task['due_at'] ? date('d/m/Y H:i', strtotime($task['due_at'])) : '-' ?>
                </li>
                <li class="list-group-item">
                    <strong>Criada em:</strong>
                    <?= $task['created_at'] ? date('d/m/Y H:i', strtotime($task['created_at'])) : '-' ?>
                </li>
                <li class="list-group-item">
                    <strong>Última atualização:</strong>
                    <?= $task['updated_at'] ? date('d/m/Y H:i', strtotime($task['updated_at'])) : '-' ?>
                </li>
            </ul>

            <div class="d-flex gap-2">
                <a href="index.php?action=list" class="btn btn-secondary">⬅ Voltar</a>
                <a href="index.php?action=edit&id=<?= $task['id'] ?>" class="btn btn-warning">✏️ Editar</a>
                <a href="index.php?action=delete&id=<?= $task['id'] ?>" 
                   class="btn btn-danger"
                   onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">🗑 Excluir</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (inclui Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
