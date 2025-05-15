<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compra</title>
    <link rel="stylesheet" href="../styles/carrito.css">
    <script defer src="../js/carrito.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="carrito-titulo">Tu Carrito de Compra</h1>
        
        <div id="contenedor-carrito">
            <!-- Aquí se cargarán dinámicamente los productos del carrito -->
        </div>
        
        <div class="carrito-resumen">
            <div class="carrito-total">
                <span>Total:</span>
                <span id="total-carrito">$0.00</span>
            </div>
            <button class="btn-comprar">Finalizar Compra</button>
            <a href="../index.php"><button class="btn-seguir-comprando">Seguir Comprando</button></a>
        </div>
    </div>
</body>
</html>