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
    <link rel="stylesheet" href="../styles/admin.css">
    <title>Admin Panel</title>
</head>

<body>

    <h1 class="text-center mt-5 fw-bold text-black">ADMIN PANEL</h1>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                    </div>

                    <div class="col-md-4">
                        <a href="./admin_dashboard.php">
                            <button type="button" class="btn btn-info w-100 fw-bold text-light">Usuarios Registrados</button>
                        </a>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                    </div>

                    <div class="col-md-4">
                        <a href="./admin_productos.php">
                            <button type="button" class="btn btn-info w-100 fw-bold text-light">Productos</button>
                        </a>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                    </div>

                    <div class="col-md-4">
                        <a href="./admin_dashboard.php">
                            <button type="button" class="btn btn-info w-100 fw-bold text-light">Usuarios Registrados</button>
                        </a>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>



</html>