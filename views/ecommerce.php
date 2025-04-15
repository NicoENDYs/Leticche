<?php
session_start()



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/ecommerce.css">
    <title>Nuestros Productos</title>
</head>

<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-custom">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-light" href="#">
                <img src="../images/Logo_Lenteja.png" width="40" height="40" class="d-inline-block align-top" alt="">
                Leticche
            </a>
            
            <!-- aparece en movil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Menu colapsable -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-light" href="../views/ecommerce.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-light" href="../views/Registro.php">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-light" href="../controllers/procesarLogout.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <H1>USER</H1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>