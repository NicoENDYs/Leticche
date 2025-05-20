<?php
require_once '../controllers/check_session.php';
require_once '../models/MySQL.php';
$mysql = new MySQL;
$mysql->conectar();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../styles/adminIndex.css">

    <link rel="stylesheet" href="../styles/adminDashboardProductos.css">
    <title>Admin Panel</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="brand">
            <img src="../images/Logo_Lenteja.png" alt="Lenticche Logo">
            <span class="d-block">Lenticche</span>
        </div>
        <ul class="nav flex-column px-3">
            <li class="nav-item" data-title="Inicio">
                <a href="./admin_index.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li class="nav-item" data-title="Usuarios">
                <a href="./admin_dashboard.php" class="nav-link ">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            <li class="nav-item" data-title="Productos">
                <a href="./admin_productos.php" class="nav-link ">
                    <i class="fas fa-box"></i>
                    <span>Productos</span>
                </a>
            </li>
            <li class="nav-item" data-title="Pedidos">
                <a href="javascript:void(0)" class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Pedidos</span>
                </a>
            </li>
            <li class="nav-item" data-title="Reportes">
                <a href="javascript:void(0)" class="nav-link active">
                    <i class="fas fa-chart-line"></i>
                    <span>Reportes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../index.php" class="nav-link">
                    <i class="fa fa-cutlery"></i>
                    <span>Ver Articulos</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../controllers/procesarLogout.php">
                    <button type="button" class="btn btn-danger fw-bold">
                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                    </button>
                </a>
            </li>
        </ul>
    </div>

    <!-- aparece en movil -->
    <nav class="navbar navbar-expand-lg navbar-light bg-custom d-lg-none">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-light" href="#">
                <img src="../images/Logo_Lenteja.png" width="40" height="40" class="d-inline-block align-top" alt="">
                Leticche
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="./admin_index.php" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./admin_dashboard.php" class="nav-link active">
                            <i class="fas fa-users"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./admin_productos.php" class="nav-link ">
                            <i class="fas fa-box"></i>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Pedidos</span>
                        </a>
                    </li>
                    <li class="nav-item" data-title="Reportes">
                        <a href="./admin_reportes.php" class="nav-link active">
                            <i class="fas fa-chart-line"></i>
                            <span>Reportes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link">
                            <i class="fa fa-cutlery"></i>
                            <span>Ver Articulos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../controllers/procesarLogout.php">
                            <button type="button" class="btn btn-danger fw-bold">
                                <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>







    <div class="main-content">
    <div class="container py-5">
        <h1 class="text-center fw-bold animate-card">Reportes</h1>

        <div class="admin-container animate-card">
            <div class="row">
                <!-- Primera tarjeta -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="menu-option">
                        <i class="fas fa-box"></i>
                        <h4>Productos</h4>
                        <p>Gestiona los Productos</p>
                        <a href="../controllers/crear_reporte_productos.php" class="mt-3 w-100">
                            <button type="button" class="btn btn-menu w-100 text-light">Generar Reporte</button>
                        </a>
                    </div>
                </div>

                <!-- Segunda tarjeta -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="menu-option">
                        <i class="fas fa-users"></i>
                        <h4>Productos</h4>
                        <p>Administra el catálogo de productos</p>
                        <a href="./admin_productos.php" class="mt-3 w-100">
                            <button type="button" class="btn btn-menu w-100 text-light">Acceder</button>
                        </a>
                    </div>
                </div>

                <!-- Tercera tarjeta -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="menu-option">
                        <i class="fas fa-chart-line"></i>
                        <h4>Estadísticas</h4>
                        <p>Visualiza el rendimiento del sistema</p>
                        <a href="javascript:void(0)" class="mt-3 w-100">
                            <button type="button" class="btn btn-menu w-100 text-light">Acceder</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>



</html>