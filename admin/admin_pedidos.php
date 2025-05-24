<?php
require_once '../controllers/check_session.php';
require_once '../models/MySQL.php';
$mysql = new MySQL;
$mysql->conectar();


$resultado = $mysql->efectuarConsulta("SELECT id, nombre, correo, telefono, cargo, Estado
    FROM usuarios");

//todos los pedidos
$consulta = "SELECT id, usuario_id, fecha, total, estado FROM pedidos";
$traerPedidos = $mysql->efectuarConsulta($consulta);

//contar todos los pedidos
$consulta = "SELECT COUNT(*) AS cantidad_pedidos FROM pedidos";
$traerCantidadPedidos = $mysql->efectuarConsulta($consulta);
$cantidadPedidos = ($fila = mysqli_fetch_assoc($traerCantidadPedidos)) ? $fila['cantidad_pedidos'] : "Error de extracción";

//contar todos los pedidos pendientes
$consulta = "SELECT COUNT(*) AS cantidad_pendientes FROM pedidos WHERE estado = 'pendiente'";
$traerPedidosPendientes = $mysql->efectuarConsulta($consulta);
$cantidadPedidosPendientes = ($fila = mysqli_fetch_assoc($traerPedidosPendientes)) ? $fila['cantidad_pendientes'] : "Error de extracción";

//contar todos los pedidos completos
$consulta = "SELECT COUNT(*) AS cantidad_completos FROM pedidos WHERE estado = 'entregado'";
$traerPedidosCompletos = $mysql->efectuarConsulta($consulta);
$cantidadPedidosCompletos = ($fila = mysqli_fetch_assoc($traerPedidosCompletos)) ? $fila['cantidad_completos'] : "Error de extracción";

//contar todos los pedidos cancelados
$consulta = "SELECT COUNT(*) AS cantidad_cancelados FROM pedidos WHERE estado = 'cancelado'";
$traerPedidosCancelados = $mysql->efectuarConsulta($consulta);
$cantidadPedidosCancelados = ($fila = mysqli_fetch_assoc($traerPedidosCancelados)) ? $fila['cantidad_cancelados'] : "Error de extracción";


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

    <link rel="stylesheet" href="../styles/pedidos.css">

</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="brand">
            <img src="../images/Logo_Lenteja.png" alt="Lenticche Logo">
            <span class="d-block">Lenticchie</span>
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

    <!-- Navbar para móvil -->
    <nav class="navbar navbar-expand-lg navbar-light bg-custom d-lg-none">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-light" href="#">
                <img src="../images/Logo_Lenteja.png" width="40" height="40" class="d-inline-block align-top" alt="">
                Lenticchie
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
                                <h3 class="counter-value"><?php echo $cantidadPedidos; ?></h3>
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
                                <h3 class="counter-value"><?php echo $cantidadPedidosPendientes; ?></h3>
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
                                <h3 class="counter-value"><?php echo $cantidadPedidosCompletos; ?></h3>
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
                                <h3 class="counter-value"><?php echo $cantidadPedidosCancelados; ?></h3>
                                <div class="title">Cancelados</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros -->
            <div class="data-card mb-4">
                <div class="card-body px-4">
                    <div class="row g-3 align-items-end mb-4">
                        <!-- Filtro Estado -->
                        <div class="col-md-4">
                            <label for="statusFilter" class="form-label">Estado</label>
                            <select class="form-select" id="statusFilter">
                                <option value="">Todos</option>
                                <option value="pending">Pendiente</option>
                                <option value="processing">Procesando</option>
                                <option value="completed">Completado</option>
                                <option value="cancelled">Cancelado</option>
                            </select>
                        </div>
                        <!-- Filtro Fecha -->
                        <div class="col-md-4">
                            <label for="dateFilter" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="dateFilter">
                        </div>
                        <!-- Botón Filtrar -->
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary w-100 mt-md-2">
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
                    <?php
                    while ($pedido = mysqli_fetch_assoc($traerPedidos)) {
                        //modificar formato de fecha
                        $nombreMeses = [
                            1 => 'Enero',
                            2 => 'Febrero',
                            3 => 'Marzo',
                            4 => 'Abril',
                            5 => 'Mayo',
                            6 => 'Junio',
                            7 => 'Julio',
                            8 => 'Agosto',
                            9 => 'Septiembre',
                            10 => 'Octubre',
                            11 => 'Noviembre',
                            12 => 'Diciembre'
                        ];
                        $traerFecha = $pedido["fecha"];
                        $dateTime = new DateTime($traerFecha);
                        $partesFecha = date_parse($pedido["fecha"]);
                        $año = $partesFecha["year"];
                        $mes = $nombreMeses[$partesFecha["month"]];
                        $dia = $partesFecha["day"];
                        $hora = $dateTime->format('g:i A');

                        $fechaPedido = "$mes-$dia-$año ($hora)";

                        //traer información del cliente
                        $consulta = "SELECT id, nombre, correo, direccion FROM usuarios WHERE id = '" . $pedido["usuario_id"] . "'";
                        $resultadoUsuarios = $mysql->efectuarConsulta($consulta);
                        $usuario = mysqli_fetch_assoc($resultadoUsuarios);
                        $direccion = strlen(trim($usuario["direccion"])) > 0 ? $usuario["direccion"] : "Sin Dirección"; 

                        //todos los productos pedidos
                        $consulta = "SELECT producto_id, cantidad, precio_unitario FROM detalles_pedido WHERE pedido_id = '" . $pedido["id"] . "'";
                        $traerProductos = $mysql->efectuarConsulta($consulta);

                        switch ($pedido["estado"]) {
                            case "pendiente":
                                $estadoPedido = "badge-pending";
                                break;
                            case "entregado":
                                $estadoPedido = "badge-success";
                                break;
                            case "procesando":
                                $estadoPedido = "badge-info";
                                break;
                        }

                        $estadoOpciones = [
                            "pendiente" => '<option value="pendiente">Pendiente</option>',
                            "procesando" => '<option value="procesando">Procesando</option>',
                            "entregado" => '<option value="entregado">Entregado</option>'
                        ];
                        ///////////////////////////////Colores//////////////////////////////////////////////
                        //badge-success  ///// ES PARA Entregado (VERDE CLARITO,FONDO GREEN GRISASEO)    ///
                        //badge-pending  ///// ES PARA PENDIENTE (NARANJA CLARITO,FONDO "YELLOW")//      ///
                        //badge-info       ///// ES PARA PROCESANDO (AZUL CLARITO,FONDO "LIGHTBLUE")     ///
                        ////////////////////////////////////////////////////////////////////////////////////
                        echo '
    <!-- Card -->
    <div class="col-md-6 col-lg-4 mb-4 animate-card">
        <div class="order-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>ID Pedido: ' . $pedido["id"] . '</div>
                <span class="order-badge ' .  $estadoPedido . '">' . $pedido["estado"] . '</span>
            </div>
            <div class="card-body">
                <!-- Contenedor para todo el contenido excepto las acciones -->
                <div class="order-content">
                    <div class="order-info">
                        <div><strong>Nombre del Cliente:</strong> ' . strtolower($usuario["nombre"]) . ' (ID: ' . $usuario["id"] . ')</div>
                    </div>
                    <div class="order-info">
                        <div><strong>Dirección:</strong> ' . strtolower($direccion) . '</div>
                    </div>
                    <div class="order-info">
                        <div><strong>Correo:</strong> ' . strtolower($usuario["correo"]) . '</div>
                    </div>
                    <div class="order-info">
                        <div><strong>Fecha Pedido:</strong> ' . $fechaPedido . '</div>
                    </div>
                    <div class="order-info">
                        <div class="label">Resumen de Artículos:</div>
                        <div class="order-items">
';

                        while ($producto = mysqli_fetch_assoc($traerProductos)) {
                            // Traer nombre del producto
                            $consulta = "SELECT nombre FROM productos WHERE id = '" . $producto["producto_id"] . "'";
                            $traerNombreProducto = $mysql->efectuarConsulta($consulta);
                            $nombreProducto = mysqli_fetch_assoc($traerNombreProducto);
                            echo '
                            <div class="order-item">
                                <span class="item-name">' . $nombreProducto["nombre"] . '</span>
                                <span class="item-price">$' . number_format($producto["precio_unitario"], 0, ",", ".") . '</span>
                                <span class="item-qty">X' . $producto["cantidad"] . '</span>
                            </div>';
                        };

                        echo '
                        </div>
                    </div>
                </div>

                <div class="order-total">
                        <label>Total:</label>
                        <span>$' . number_format($pedido["total"], 0, ",", ".") . '</span>
                    </div>
                
                <!-- Acciones siempre al final -->
                <form method="POST" action="../controllers/cambiarEstadoPedido.php">
                    <div class="order-actions">
                    <input type="hidden" name="id_pedido" value="' . $pedido["id"] . '">
                        <select class="form-select" aria-label="Default select example" name="estado_pedido" required>
                            <option value="" disabled selected>Cambiar Estado</option>';
                        foreach ($estadoOpciones as $clave => $opcionHtml) {
                            if ($clave === $pedido['estado']) {
                                continue; // Salta esta opción
                            }
                            echo $opcionHtml;
                        }
                        echo '
                        </select>
                        <button class="btn btn-order-action btn-success">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
';
                    }

                    $mysql->desconectar();
                    ?>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>