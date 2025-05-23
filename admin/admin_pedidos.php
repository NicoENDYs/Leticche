<?php
require_once '../controllers/check_session.php';
require_once '../models/MySQL.php';
$mysql = new MySQL;
$mysql->conectar();


$resultado = $mysql->efectuarConsulta("SELECT id, nombre, correo, telefono, cargo, Estado
    FROM usuarios");

//total usuarios
$consulta = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
$resultadoUsuarios = $mysql->efectuarConsulta($consulta);
$totalUsuarios = ($fila = mysqli_fetch_assoc($resultadoUsuarios)) ? $fila['total_usuarios'] : "Error de extracción";

//total usuarios activo
$consulta = "SELECT COUNT(*) AS total_usuarios_activos FROM usuarios WHERE Estado = 'ACTIVO'";
$resultadoUsuarios = $mysql->efectuarConsulta($consulta);
$totalUsuariosActivos = ($fila = mysqli_fetch_assoc($resultadoUsuarios)) ? $fila['total_usuarios_activos'] : "Error de extracción";

//total usuarios inactivo
$consulta = "SELECT COUNT(*) AS total_usuarios_inactivos FROM usuarios WHERE Estado = 'INACTIVO'";
$resultadoUsuarios = $mysql->efectuarConsulta($consulta);
$totalUsuariosInactivos = ($fila = mysqli_fetch_assoc($resultadoUsuarios)) ? $fila['total_usuarios_inactivos'] : "Error de extracción";

$mysql->desconectar();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pedidos - Lenticche</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../styles/adminDashboardProductos.css">

</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="brand">
            <img src="../images/Logo_Lenteja.png" alt="Lenteja Logo">
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
                <a href="./admin_dashboard.php" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            <li class="nav-item" data-title="Productos">
                <a href="./admin_productos.php" class="nav-link">
                    <i class="fas fa-box"></i>
                    <span>Productos</span>
                </a>
            </li>
            <li class="nav-item" data-title="Pedidos">
                <a href="javascript:void(0)" class="nav-link active">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Pedidos</span>
                </a>
            </li>
            <li class="nav-item" data-title="Reportes">
                <a href="./admin_reportes.php" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Reportes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="../index.php" class="nav-link">
                    <i class="fa fa-cutlery"></i>
                    <span>Ver Artículos</span>
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
            <a class="navbar-brand fw-bold text-light" href="javascript:void(0)">
                <img src="../images/Logo_Lenteja.png" width="40" height="40" class="d-inline-block align-top" alt="">
                Lenticche
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item" data-title="Inicio">
                        <a href="./admin_index.php" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item" data-title="Usuarios">
                        <a href="./admin_dashboard.php" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-item" data-title="Productos">
                        <a href="./admin_productos.php" class="nav-link">
                            <i class="fas fa-box"></i>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li class="nav-item" data-title="Pedidos">
                        <a href="javascript:void(0)" class="nav-link active">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Pedidos</span>
                        </a>
                    </li>
                    <li class="nav-item" data-title="Reportes">
                        <a href="./admin_reportes.php" class="nav-link">
                            <i class="fas fa-chart-line"></i>
                            <span>Reportes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link">
                            <i class="fa fa-cutlery"></i>
                            <span>Ver Artículos</span>
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

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <button class="sidebar-toggle d-none d-lg-block" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="navbar-brand d-none d-md-block">Panel de Control</span>
                <div class="ms-auto d-flex align-items-center">
                    
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <!-- titulo -->
            <div class="welcome-section">
                <div class="row">
                    <div class="col-lg-8">
                        <h2>Gestión de Pedidos</h2>
                        <p class="text-muted">Aquí puedes ver y administrar todos los pedidos realizados en la tienda.</p>
                    </div>
                </div>
            </div>

            <!-- Estadisticas -->
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card users animate-card">
                        <div class="d-flex align-items-center">
                            <div class="icon">
                                <i class="fas fa-shopping-cart fa-lg"></i>
                            </div>
                            <div class="ms-auto text-end">
                                <h3 class="counter-value">124</h3>
                                <div class="title">Total Pedidos</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card active animate-card">
                        <div class="d-flex align-items-center">
                            <div class="icon">
                                <i class="fas fa-clock fa-lg"></i>
                            </div>
                            <div class="ms-auto text-end">
                                <h3 class="counter-value">28</h3>
                                <div class="title">Pendientes</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card inactive animate-card">
                        <div class="d-flex align-items-center">
                            <div class="icon">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </div>
                            <div class="ms-auto text-end">
                                <h3 class="counter-value">82</h3>
                                <div class="title">Completados</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card users animate-card">
                        <div class="d-flex align-items-center">
                            <div class="icon">
                                <i class="fas fa-ban fa-lg"></i>
                            </div>
                            <div class="ms-auto text-end">
                                <h3 class="counter-value">14</h3>
                                <div class="title">Cancelados</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros -->
            <div class="data-card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3 ml-5">
                            <label for="statusFilter" class="form-label">Estado</label>
                            <select class="form-select" id="statusFilter">
                                <option value="">Todos</option>
                                <option value="pending">Pendiente</option>
                                <option value="processing">Procesando</option>
                                <option value="completed">Completado</option>
                                <option value="cancelled">Cancelado</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="dateFilter" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="dateFilter">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label d-none d-md-block">&nbsp;</label>
                            <button type="button" class="btn btn-primary w-100">
                                <i class="fas fa-filter me-2"></i>Filtrar
                            </button>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="text-center mb-5">
                <button id="startOverBtn" class="btn btn-primary">
                    <i class="fas fa-redo-alt me-2"></i>Recargar
                </button>
            </div>
            <!-- Cards Container -->
            <div id="ordersContainer">
                <div class="row" id="orderCards">
                    <!-- Card 1 -->
                    <div class="col-md-6 col-lg-4 mb-4 animate-card">
                        <div class="order-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>ID Pedido: 001</div>
                                <span class="order-badge badge-pending">Pendiente</span>
                            </div>
                            <div class="card-body">
                                <div class="order-info">
                                    <div class="label">Nombre del Cliente:</div>
                                    <div class="value">Ioni</div>
                                </div>
                                <div class="order-info">
                                    <div class="label">Fecha del Pedido:</div>
                                    <div class="value">14 de Mayo</div>
                                </div>
                                <div class="order-items">
                                    <div class="label">Resumen de Artículos:</div>
                                    <div class="order-item">
                                        <span>Ensalada de Lentejas</span>
                                        <span>x2</span>
                                    </div>
                                    <div class="order-item">
                                        <span>Hamburguesa Vegetariana</span>
                                        <span>x1</span>
                                    </div>
                                    <div class="order-item">
                                        <span>Jugo Natural</span>
                                        <span>x3</span>
                                    </div>
                                </div>
                                <div class="order-total">
                                    Total: $45.90
                                </div>
                                <div class="order-actions">
                                    <button class="btn btn-order-action btn-view">
                                        <i class="fas fa-eye me-1"></i> Ver
                                    </button>
                                    <button class="btn btn-order-action btn-process">
                                        <i class="fas fa-check me-1"></i> Procesar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-6 col-lg-4 mb-4 animate-card">
                        <div class="order-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>ID Pedido: 002 </div>
                                <span class="order-badge badge-processing">Procesando</span>
                            </div>
                            <div class="card-body">
                                <div class="order-info">
                                    <div class="label">Nombre del Cliente:</div>
                                    <div class="value">Uari</div>
                                </div>
                                <div class="order-info">
                                    <div class="label">Fecha del Pedido:</div>
                                    <div class="value">14 de Mayo</div>
                                </div>
                                <div class="order-items">
                                    <div class="label">Resumen de Artículos:</div>
                                    <div class="order-item">
                                        <span>Sopa de Lentejas</span>
                                        <span>x2</span>
                                    </div>
                                    <div class="order-item">
                                        <span>Ensalada César</span>
                                        <span>x1</span>
                                    </div>
                                    <div class="order-item">
                                        <span>Refresco</span>
                                        <span>x2</span>
                                    </div>
                                </div>
                                <div class="order-total">
                                    Total: $38.75
                                </div>
                                <div class="order-actions">
                                    <button class="btn btn-order-action btn-view">
                                        <i class="fas fa-eye me-1"></i> Ver
                                    </button>
                                    <button class="btn btn-order-action btn-cancel">
                                        <i class="fas fa-times me-1"></i> Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-6 col-lg-4 mb-4 animate-card">
                        <div class="order-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>ID Pedido: 003</div>
                                <span class="order-badge badge-completed">Completado</span>
                            </div>
                            <div class="card-body">
                                <div class="order-info">
                                    <div class="label">Nombre del Cliente:</div>
                                    <div class="value">Ruí</div>
                                </div>
                                <div class="order-info">
                                    <div class="label">Fecha del Pedido:</div>
                                    <div class="value">14 de Mayo</div>
                                </div>
                                <div class="order-items">
                                    <div class="label">Resumen de Artículos:</div>
                                    <div class="order-item">
                                        <span>Plato del Día</span>
                                        <span>x3</span>
                                    </div>
                                    <div class="order-item">
                                        <span>Postre Casero</span>
                                        <span>x3</span>
                                    </div>
                                    <div class="order-item">
                                        <span>Café</span>
                                        <span>x3</span>
                                    </div>
                                </div>
                                <div class="order-total">
                                    Total: $62.50
                                </div>
                                <div class="order-actions">
                                    <button class="btn btn-order-action btn-view">
                                        <i class="fas fa-eye me-1"></i> Ver
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>