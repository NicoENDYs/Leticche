<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color:rgb(255, 248, 168);
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
        }
        .form-container {
            max-width: 450px;
            margin: auto;
            margin-top: 50px;
            background-color:rgb(113, 165, 109);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
        }
        .form-control, .form-check-label {
            background-color:rgb(55, 77, 53);
            border: 1px solid #555;
            color: #fff;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }
        .btn-primary {
            background-color:rgb(55, 77, 53);
            border: none;
        }
        .btn-primary:hover {
            background-color: #2962ff;
        }
        .social-icons i {
            font-size: 1.5rem;
            margin: 0 10px;
            color: #bbb;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 class="text-center mb-3">Registro</h2>
    
    <div class="text-center mb-3 social-icons">
        <i class="bi bi-google"></i>
        <i class="bi bi-twitter"></i>
    </div>

    <form action="procesarRegistro.php" method="POST">
    <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>            
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
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
            
            <label class="form-check-label" for="terminos">
                acepto terminios y condiciones
            </label>
        

        </div>
        <button type="submit" class="btn btn-primary w-100">REGISTRAR</button>


        <div class="text-center mt-3">
            <p>¿Ya tienes una cuenta? <a href="login.php" class="text-primary">Iniciar sesión</a></p>
        </div>
    </form>
</div>

<!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
