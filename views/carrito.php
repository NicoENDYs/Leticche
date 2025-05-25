<?php

session_start();

if (
    empty($_SESSION['usuario_id']) ||
    empty($_SESSION['nombre']) ||
    empty($_SESSION['cargo']) ||
    empty($_SESSION['correo'])
) {
    header("Location: ./Login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compra</title>
    <link rel="stylesheet" href="../styles/carrito.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <button class="open-modal-btn btn-comprar" id="verFacturaBtn">Resumen De Compra</button>
            <a href="../index.php"><button class="btn-seguir-comprando">Seguir Comprando</button></a>
        </div>
    </div>
    <!-- Modal de Factura -->
    <div class="modal-overlay" id="modalFactura" style="display: none;">
        <div class="modal-factura">
            <div class="modal-header">
                <div class="modal-title">Resumen de tu Compra</div>
                <button class="close-btn" id="cerrarModalBtn">&times;</button>
            </div>
            <div class="modal-body">
                <div class="factura-info">
                    <div class="factura-numero">Factura No: <strong>F-2025001</strong></div>
                    <div class="factura-fecha">Fecha: <strong id="fechaActual">19/05/2025</strong></div>
                </div>

                <div class="factura-cliente">
                    <h3>Información del Cliente</h3>
                    <p id="nombreCliente">Cliente: <?php echo strtolower($_SESSION['nombre'] )?></p>
                    <div class="direccion-container">
                        <label for="direccionCliente" class="form-label">Direccion a enviar:</label>
                        <input type="text" name="direccion" id="direccionCliente" placeholder="Ingrese Dirección"
                            class="direccion-input py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                </div>


                <table class="factura-tabla" id="tablaFactura">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Producto</th>
                            <th class="cantidad">Cant.</th>
                            <th class="precio">Precio</th>
                            <th class="subtotal">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="facturaItems">
                        <!-- Los items se cargarán dinámicamente -->
                    </tbody>
                </table>

                <div class="factura-resumen">
                    <div class="resumen-fila">
                        <span>Subtotal:</span>
                        <span id="facturaSubtotal">$308.000</span>
                    </div>
                    <div class="resumen-fila">
                        <span>Envio:</span>
                        <span id="facturaImpuesto">$58.520</span>
                    </div>
                    <div class="total-fila">
                        <span>TOTAL:</span>
                        <span id="facturaTotal">$366.520</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="volverBtn">Volver al carrito</button>
                <button class="btn btn-primary" id="confirmarBtn"
                    data-id-usuario="<?php echo $_SESSION['usuario_id'] ?>">Confirmar Pedido</button>
            </div>
        </div>
    </div>

    <!-- Formulario oculto para procesar los datos -->
    <form id="formFactura" action="../controllers/procesarCompra.php" method="POST" style="display: none;">
        <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuario_id'] ?>">
        <input type="hidden" name="productos_ocultos" id="productos_ocultos" value="">
        <input type="hidden" name="direccion_envio" id="direccion_envio" value="">
        <input type=" hidden" name="total_pedido" id="totalOculto">
    </form>
</body>

</html>