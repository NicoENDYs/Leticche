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
    <title>Admin Panel</title>
</head>

<body>

<div class="container py-5">
        <h1 class="text-center fw-bold animate-card">ADMIN PANEL</h1>
        
        <div class="admin-container animate-card">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="menu-option">
                        <i class="fas fa-users"></i>
                        <h4>Usuarios Registrados</h4>
                        <p>Gestiona los usuarios del sistema</p>
                        <a href="./admin_dashboard.php" class="mt-3 w-100">
                            <button type="button" class="btn btn-menu w-100">Acceder</button>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="menu-option">
                        <i class="fas fa-box-open"></i>
                        <h4>Productos</h4>
                        <p>Administra el catálogo de productos</p>
                        <a href="./admin_productos.php" class="mt-3 w-100">
                            <button type="button" class="btn btn-menu w-100">Acceder</button>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="menu-option">
                        <i class="fas fa-chart-line"></i>
                        <h4>Estadísticas</h4>
                        <p>Visualiza el rendimiento del sistema</p>
                        <a href="javascript:void(0)" class="mt-3 w-100">
                            <button type="button" class="btn btn-menu w-100">Acceder</button>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="logout-section">
                <a href="../controllers/procesarLogout.php">
                    <button type="button" class="btn btn-danger fw-bold">
                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                    </button>
                </a>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>



</html>