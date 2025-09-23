<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Erro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <div class="alert alert-danger">
        <h4>Erro</h4>
        <p><?= htmlspecialchars($error) ?></p>
    </div>

    <a href="index.php?action=list" class="btn btn-primary">Voltar para minhas tarefas</a>

</body>
</html>
