<!DOCTYPE html>
<html>
<head>
    <title>Registrar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="mb-4 text-center">Registrar</h2>
            <form method="POST" action="register.php" class="card p-4 shadow">
                <div class="mb-3">
                    <label class="form-label">Nome de Usuário:</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Registrar</button>
            </form>
            <p class="mt-3 text-center">Já tem conta? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>
