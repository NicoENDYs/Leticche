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
    <link rel="stylesheet" href="../styles/adminDashboardProductos.css">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <link rel="stylesheet" href="../styles/adminDashboardProductos.css">
    <title>Admin Dashboard</title>
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
                <a href="./admin_dashboard.php" class="nav-link active">
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
                <a href="./admin_pedidos.php" class="nav-link">
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
                Lenticche
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
                        <a href="./admin_productos.php" class="nav-link">
                            <i class="fas fa-box"></i>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./admin_pedidos.php" class="nav-link">
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






    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <span class="navbar-brand d-none d-md-block">Panel de Control</span>
            </div>
        </nav>

        <!-- Welcome Section -->
        <div class="welcome-section animate-card">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2>Gestión de Usuarios</h2>
                    <p class="text-muted mb-0">Administre los usuarios registrados en el sistema y sus permisos.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="./admin_index.php" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="stat-card users animate-card" style="animation-delay: 0.1s">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="title">Total Usuarios</div>
                            <h3 class="counter-value"><?php echo $totalUsuarios ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="stat-card active animate-card" style="animation-delay: 0.2s">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="title">Usuarios Activos</div>
                            <h3 class="counter-value"><?php echo $totalUsuariosActivos ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="stat-card inactive animate-card" style="animation-delay: 0.3s">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="title">Usuarios Inactivos</div>
                            <h3 class="counter-value"><?php echo $totalUsuariosInactivos ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-slash fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Users Table -->
        <div class="data-card animate-card" style="animation-delay: 0.4s">
            <div class="card-header">
                <h5>Usuarios Registrados</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php if (mysqli_num_rows($resultado) > 0): ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Cargo</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($usuarios = mysqli_fetch_assoc($resultado)): ?>
                                    <tr>
                                        <td><?php echo $usuarios['id']; ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar">
                                                    <?php echo strtoupper(substr($usuarios['nombre'], 0, 1)); ?>
                                                </div>
                                                <span class="user-name"><?php echo $usuarios['nombre']; ?></span>
                                            </div>
                                        </td>
                                        <td><?php echo $usuarios['correo']; ?> </td>
                                        <td>
                                            <?php
                                            $tel = preg_replace('/\D/', '', $usuarios['telefono']);
                                            if (strlen($tel) === 10) {
                                                echo substr($tel, 0, 3) . '-' . substr($tel, 3, 3) . '-' . substr($tel, 6);
                                            } else {
                                                echo $usuarios['telefono'];
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $usuarios['cargo']; ?></td>
                                        <td>
                                            <?php if ($usuarios['Estado'] == 'ACTIVO'): ?>
                                                <span class="status-badge status-active">
                                                    <i class="fas fa-check-circle"></i> Activo
                                                </span>
                                            <?php else: ?>
                                                <span class="status-badge status-inactive">
                                                    <i class="fas fa-times-circle"></i> Inactivo
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">

                                            <?php if ($usuarios['Estado'] == 'ACTIVO'): ?>
                                                <a href="../controllers/EliminarUsuario.php?id=<?php echo $usuarios['id']; ?>"
                                                    class="btn btn-sm btn-outline-danger btn-action"
                                                    title="Eliminar"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                                    <i class="fas fa-user-slash "></i>
                                                </a>
                                            <?php else: ?>
                                                <a href="../controllers/ActivarUsuario.php?id=<?php echo $usuarios['id']; ?>"
                                                    class="btn btn-sm btn-outline-success btn-action"
                                                    title="Activar"
                                                    onclick="return confirm('¿Estás seguro de que deseas Activar este usuario?');">
                                                    <i class="fas fa-user"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center mt-5 text-black">No hay Usuarios registrados.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center text-muted py-3">
            <p class="mb-0">&copy; 2025 Lenticche. Todos los derechos reservados.</p>
        </footer>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <!-- CountUp.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.7/countUp.min.js"></script>
    <!-- Custom JS -->

</html>