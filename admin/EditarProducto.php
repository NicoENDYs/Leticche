<?php
require_once '../controllers/check_session.php';

require_once '../models/MySQL.php';

if (!isset($_GET['id'])) {
    echo "Id no encontrado";
    exit();
}
$id = $_GET['id'];

$mysql = new MySQL;
$mysql->conectar();

$resultado = $mysql->efectuarConsulta("SELECT * FROM productos WHERE id = '$id'");
$producto = mysqli_fetch_assoc($resultado);

$mysql->desconectar();

if (!$producto) {
    echo "Producto no encontrado";
    exit();
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Editar Productos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/formularios.css">
</head>

<body>
    <div class="form-container">
    
        <h2 class="text-center mb-3">Editar producto</h2>

        <form action="../controllers/EditarProducto.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $producto['descripcion']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $producto['stock']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Estado</label> <br>
                <label for="stock" class="form-label">Activo</label>
                <input type="radio" class="form-check-input" id="Estado" name="Estado" value="ACTIVO" <?php if ($producto['Estado'] === 'ACTIVO') echo 'checked'; ?> required>
                <label for="stock" class="form-label">Inactivo</label>
                <input type="radio" class="form-check-input" id="Estado" name="Estado" value="INACTIVO" <?php if ($producto['Estado'] === 'INACTIVO') echo 'checked'; ?> required>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label> <br>
                <input type="file" class="form-control" id="imagen" name="imagen">
                imagen actual: <br>
                <div class="image-preview mt-2" id="imagePreview">
                    <div class="image-preview-placeholder">
                        <img src="../img/<?php echo $producto['imagen']; ?>" alt="" width="70%"> <br>
                        
                    </div>
                </div>


                
            </div>

            <button type="submit" name="Enviar" id="Enviar" class="btn btn-primary w-100">Editar Producto</button>
            
        </form>
        <br>
        <a href="./admin_productos.php" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>