    <?php
    require_once '../models/MySQL.php';
    $mysql = new MySQL;
    $mysql->conectar();


    $resultado = $mysql->efectuarConsulta("SELECT id, nombre, descripcion, precio, stock, imagen, estado
    FROM productos");


    $mysql->desconectar();
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FastFood - Tu Comida Rápida Favorita</title>
        <!-- TailwindCSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../styles/ecommerce.css">

        <script defer src="../js/ecommerce.js"></script>
    </head>

    <body>
        <!-- Header con navegación -->
        <header class="header">
            <nav class="navbar">
                <a href="javascript:void(0)" class="logo">Letti<span>che</span></a>
                <div class="nav-links">
                    <a href="javascript:void(0)" class="nav-item">
                        <span class="nav-item-text">Iniciar Sesión</span>
                        <i class="fas fa-user-circle d-inline d-md-none"></i>
                    </a>
                    <a href="javascript:void(0)" class="nav-item">
                        <span class="nav-item-text">Crear Cuenta</span>
                        <i class="fas fa-user-plus d-inline d-md-none"></i>
                    </a>
                    <a href="javascript:void(0)" class="nav-item cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">0</span>
                    </a>
                </div>
            </nav>
        </header>

        <div class="container">
            <!-- Categoría: Hamburguesas -->
            <div class="products-row">


                <?php if (mysqli_num_rows($resultado) > 0): ?>
                    <!-- Producto 1 -->

                    <?php while ($producto = mysqli_fetch_assoc($resultado)): ?>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="../img/<?php echo $producto['imagen']; ?>" alt="Hamburguesa Clásica">
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><?php echo $producto['nombre']; ?></h3>
                                <p class="product-description"><?php echo $producto['descripcion']; ?></p>
                                <div class="product-price">
                                    <span class="current-price">$<?php echo $producto['precio']; ?></span>
                                </div>
                                <div class="product-footer">
                                    <div class="rating">
                                        <div class="stars">★★★★☆</div>
                                        <span class="rating-count">(45)</span>
                                    </div>
                                    <button class="add-to-cart">Añadir</button>
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