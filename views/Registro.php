<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/LoginRegis.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="form-container">
        <?php if (isset($_GET['error']) && $_GET['error'] == '99'): ?>
            <div class="alert alert-danger mt-3" role="alert">
                Las contaseñas no coinciden
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == '100'): ?>
            <div class="alert alert-danger mt-3" role="alert">
                El correo ya esta registrado por otro usuario
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == '101'): ?>
            <div class="alert alert-danger mt-3" role="alert">
                El telefono ya esta registrado por otro usuario
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] == '120_telefono_invalido'): ?>
            <div class="alert alert-danger mt-3" role="alert">
                El telefono no es valido (10 digitos)
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == '102'): ?>
            <div class="alert alert-danger mt-3" role="alert">
                Algo salio mal, revise los datos
            </div>
        <?php endif; ?>

        


        <h2 class="text-center mb-3">Registro</h2>
        <form action="../controllers/procesarRegistro.php" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                value="<?php echo htmlspecialchars($_GET['nombre'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" 
                value="<?php echo htmlspecialchars($_GET['correo'] ?? ''); ?>"required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono"
                value="<?php echo htmlspecialchars($_GET['telefono'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <div class="mb-3">
                <label for="confirmar_contrasena" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" required>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="terminos" required>
                <label class="form-check-label" for="terminos">Acepto términos y condiciones</label>
            </div>
            <button type="submit" name="Enviar" id="Enviar" class="btn btn-primary w-100">REGISTRAR</button>

            <div class="text-center mt-3">
                <p>¿Ya tienes una cuenta? <a href="Login.php" class="text-primary">Iniciar sesión</a></p>
            </div>
        </form>
    </div>
</body>

</html>