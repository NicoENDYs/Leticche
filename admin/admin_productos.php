<?php
require_once '../controllers/check_session.php';
require_once '../models/MySQL.php';
$mysql = new MySQL;
$mysql->conectar();


$resultado = $mysql->efectuarConsulta("
SELECT id, nombre, descripcion, precio,stock, Estado, imagen
FROM productos");

$mysql->desconectar();
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
    <!-- Chart.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../styles/adminDashboardProductos.css">
    <title>Admin Productos</title>
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
                <a href="./admin_dashboard.php" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            <li class="nav-item" data-title="Productos">
                <a href="./admin_productos.php" class="nav-link active">
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

    <!-- Navbar para móvil -->
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
                        <a href="./admin_dashboard.php" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./admin_productos.php" class="nav-link active">
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
                </ul>
            </div>
        </div>
    </nav>


    <!-- Main Content -->


    <div class="main-content" id="mainContent">
        <?php if (isset($_GET['exito']) && $_GET['exito'] == '100'): ?>
            <div class="alert alert-success mt-3" role="alert">
                Producto Creado Con Éxito
            </div>
        <?php endif; ?>
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
                    <h2>Gestión de Productos</h2>
                    <p class="text-muted mb-0">Administre los productos disponibles en el sistema.</p>
                </div>

                <div class="col-md-6 text-md-end">
                    <a href="./admin_index.php" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                </div>

                <div class="col-md-12 text-md-end">
                    <a href="../admin/NuevoProducto.php" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-plus me-1"></i> Agregar Producto
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="stat-card active animate-card" style="animation-delay: 0.2s">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="title">Productos Activos</div>
                            <h3 class="counter-value">98</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="stat-card inactive animate-card" style="animation-delay: 0.3s">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="title">Sin Stock</div>
                            <h3 class="counter-value">27</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="data-card animate-card" style="animation-delay: 0.4s">
            <div class="card-header">
                <h5>Productos Registrados</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <?php if (mysqli_num_rows($resultado) > 0): ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th>Imagen</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($productos = mysqli_fetch_assoc($resultado)): ?>
                                    <tr>
                                        <td><?php echo $productos['id']; ?></td>
                                        <td><?php echo $productos['nombre']; ?></td>
                                        <td><?php echo $productos['descripcion']; ?></td>
                                        <td><?php echo $productos['precio']; ?></td>
                                        <td><?php echo $productos['stock']; ?></td>
                                        <td>
                                            <?php if ($productos['Estado'] == 'ACTIVO'): ?>
                                                <span class="status-badge status-active">
                                                    <i class="fas fa-check-circle"></i> Activo
                                                </span>
                                            <?php else: ?>
                                                <span class="status-badge status-inactive">
                                                    <i class="fas fa-times-circle"></i> Inactivo
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td><img src="../img/<?php echo $productos['imagen']; ?>" width="100" height="80"></td>
                                        </td>
                                        <td class="text-center">
                                            <a href="EditarProducto.php?id=<?php echo $productos['id']; ?>" class="btn btn-sm btn-outline-info btn-action" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="../controllers/EliminarProducto.php?id=<?php echo $productos['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este Producto?');" class="btn btn-sm btn-outline-danger btn-action" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center mt-5 text-black">No hay productos registrados.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Footer -->
            <footer class="text-center text-muted py-3">
                <p class="mb-0">&copy; 2025 Lenticche. Todos los derechos reservados.</p>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../js/adminProductos.js"></script>
</body>

</html>