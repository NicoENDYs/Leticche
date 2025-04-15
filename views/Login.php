<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/LoginRegis.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <h2 class="text-center mb-3">Login</h2>
        
        <div class="text-center mb-3 social-icons">
            <i class="bi bi-google"></i>
            <i class="bi bi-twitter"></i>
        </div>

        <form action="../controllers/procesarLogin.php" method="POST">            
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <button type="submit" name="Enviar" id="Enviar" class="btn btn-primary w-100">INGRESAR</button>

            <div class="text-center mt-3">
                <p>¿No tienes cuenta? <a href="Registro.php" class="text-primary">Registrarse</a></p>
            </div>
        </form>
    </div>
</body>
</html>