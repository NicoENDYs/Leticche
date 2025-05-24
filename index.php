<?php

session_start();

require_once './models/MySQL.php';
$mysql = new MySQL;
$mysql->conectar();


$resultado = $mysql->efectuarConsulta("SELECT id, nombre, descripcion, precio, stock, imagen, estado
    FROM productos WHERE Estado = 'ACTIVO'");


$mysql->desconectar();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lenticchie</title>
    
    <link rel="stylesheet" href="./styles/ecommerce.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script defer src="./js/productosStorage.js"></script>
    <script>
        function nomenclaturaPrecio(precio) {
            return `$${parseFloat(precio).toLocaleString("es-CL")}`;
        }

        document.addEventListener("DOMContentLoaded", function() {
            const precios = document.querySelectorAll('.current-price');

            precios.forEach(span => {
                const rawPrecio = span.dataset.precio;
                span.innerText = nomenclaturaPrecio(rawPrecio);
            });
        });
    </script>
</head>

<body>
    <!-- Header con navegación -->
    <header class="header">
        <nav class="navbar">
            <div class="brand">
                <img src="./images/Logo_Lenteja.png" alt="Lenticche Logo">
                <a href="#" class="logo">Lenti<span>cchie</span></a>
            </div>

            <div class="nav-links">
                <?php
                if (
                    empty($_SESSION['usuario_id']) ||
                    empty($_SESSION['nombre']) ||
                    empty($_SESSION['cargo']) ||
                    empty($_SESSION['correo'])
                ) {
                    echo '
                            <a href="./views/Login.php" class="nav-item">
                                <span class="nav-item-text" id="iniciarSesion">Iniciar Sesión</span>
                                <i class="fas fa-user-circle d-inline d-md-none"></i>
                            </a>
                            <a href="./views/Login.php?info=10" class="nav-item cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-count">0</span>
                            </a>
                        ';
                } else {
                    $nombre = isset($_SESSION['nombre']) ? htmlspecialchars(strtolower($_SESSION['nombre'])) : 'Usuario';
                    echo '
                            <span class="nav-item-text">Hola, ' . $nombre . '</span>
                            <a href="./controllers/procesarLogout.php" class="nav-item">
                                <span class="nav-item-text">Cerrar sesión</span>
                                <i class="fa fa-sign-out d-inline d-md-none"></i>
                            </a>
                            <a href="./views/carrito.php" class="nav-item cart-icon">
                              <i class="fas fa-shopping-cart"></i>
                              <span class="cart-count">0</span>
                            </a>
                        ';
                }
                ?>

            </div>
        </nav>
    </header>

    <div class="container">
        <!-- Categoría: Hamburguesas -->
        <div class="products-row">


            <?php if (mysqli_num_rows($resultado) > 0): ?>
                <!-- Producto 1 -->

                <?php while ($producto = mysqli_fetch_assoc($resultado)): ?>
                    <div class="product-card" id='<?php echo $producto['id'] ?>'>
                        <div class="product-image">
                            <img src="./img/<?php echo $producto['imagen']; ?>" alt="Hamburguesa Clásica">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><?php echo $producto['nombre']; ?></h3>
                            <p class="product-description"><?php echo $producto['descripcion']; ?></p>
                            <div class="product-price">
                                <span class="current-price" data-precio="<?php echo $producto['precio']; ?>"></span>
                            </div>
                            <div class="product-footer">
                                <div class="rating">
                                    <!--<div class="stars">★★★★☆</div>
                                        <span class="rating-count">(45)</span>
                                        -->
                                </div>
                                <?php if (
                                    empty($_SESSION['usuario_id']) &&
                                    empty($_SESSION['nombre']) &&
                                    empty($_SESSION['cargo']) &&
                                    empty($_SESSION['correo'])
                                ): ?>

                                    <a href="./views/Login.php?info=10" class="nav-item">
                                        <span class="nav-item-text">
                                            <button class="add-login btn">Añadir</button></span>
                                    </a>

                                <?php else: ?>

                                    <button class="add-to-cart" onclick='almacenarProductoStorage(<?php $producto["cantidad"] = 1;
                                    echo json_encode($producto); ?>)'>Añadir</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center mt-5 text-black">No hay Usuarios registrados.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>