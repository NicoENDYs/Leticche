<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/LoginRegis.css">
</head>

<body>
    <div class="form-container">
        <?php if (isset($_GET['info']) && $_GET['info'] == '10'): ?>
            <div class="alert alert-success mt-3" role="alert">
                Inicie Sesión para Añadir Productos
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'Correo_enviado'): ?>
            <div class="alert alert-success mt-3" role="alert">
                Correo enviado con éxito. <br>
                Revise su bandeja de entrada o carpeta de spam para restablecer su contraseña.
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'Contrasena_cambiada'): ?>
            <div class="alert alert-success mt-3" role="alert">
                Contraseña cambiada con éxito. <br>
                Ahora puede iniciar sesión con su nueva contraseña.
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'Codigo_invalido'): ?>
            <div class="alert alert-warning mt-3" role="alert">
                expiro el tiempo de espera del codigo o el codigo es invalido, por favor solicite un nuevo codigo   
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['info']) && $_GET['info'] == '111'): ?>
            <div class="alert alert-success mt-3" role="alert">
                Usuario creado con Exito. <br>
                Ahora inicia sesión
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] == 'acceso_denegado'): ?>
            <div class="alert alert-info mt-3" role="alert">
                Inicie Sesión de nuevo para acceder
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == '1'): ?>
            <div class="alert alert-danger mt-3" role="alert">
                Revise sus datos, algo esta mal
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == '101'): ?>
            <div class="alert alert-danger mt-3" role="alert">
                El telefono no es valido, debe tener 10 Digitos
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == '102'): ?>
            <div class="alert alert-danger mt-3" role="alert">
                El Correo no es valido
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == '99'): ?>
            <div class="alert alert-danger mt-3" role="alert">
                Rellene todos los datos
            </div>
        <?php endif; ?>

        <h2 class="text-center mb-3">Login</h2>
            
        <form action="../controllers/procesarLogin.php" method="POST">
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
            <div class="text-center mt-3">
                <p><a href="recuperarContrasena.php" class="text-danger">Olvide mi contraseña</a></p>
            </div>
        </form>
    </div>
</body>

</html>