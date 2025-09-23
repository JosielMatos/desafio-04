<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($task) ? 'Editar Tarefa' : 'Nova Tarefa' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <?php include __DIR__ . '/partials/navbar.php'; ?>

    <h1><?= isset($task) ? 'Editar Tarefa' : 'Nova Tarefa' ?></h1>

    <form method="POST" action="index.php?action=<?= isset($task) ? 'update&id=' . $task['id'] : 'store' ?>">

        <?php if (isset($task)): ?>
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
        <?php endif; ?>
        
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control"
                   value="<?= isset($task) ? htmlspecialchars($task['title']) : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea name="description" id="description" class="form-control" rows="4"><?= isset($task) ? htmlspecialchars($task['description']) : '' ?></textarea>
        </div>

        <div class="mb-3">
            <label for="due_at" class="form-label">Data de Entrega</label>
            <input type="datetime-local" name="due_at" id="due_at" class="form-control"
                   value="<?= isset($task['due_at']) ? date('Y-m-d\TH:i', strtotime($task['due_at'])) : '' ?>">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <?php 
                $statuses = ['pending' => 'Pendente', 'in_progress' => 'Em andamento', 'done' => 'Concluída'];
                $current = isset($task) ? $task['status'] : 'pending';
                foreach ($statuses as $value => $label): ?>
                    <option value="<?= $value ?>" <?= $current === $value ? 'selected' : '' ?>>
                        <?= $label ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Prioridade</label>
            <select name="priority" id="priority" class="form-select">
                <?php 
                $priorities = ['low' => 'Baixa', 'medium' => 'Média', 'high' => 'Alta'];
                $current = isset($task) ? $task['priority'] : 'low';
                foreach ($priorities as $value => $label): ?>
                    <option value="<?= $value ?>" <?= $current === $value ? 'selected' : '' ?>>
                        <?= $label ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            <?= isset($task) ? 'Atualizar' : 'Adicionar' ?>
        </button>
        <a href="index.php?action=list" class="btn btn-secondary">Cancelar</a>
    </form>

    <!-- Bootstrap JS Bundle (inclui Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
