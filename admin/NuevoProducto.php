<?php
require_once '../controllers/check_session.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/formularios.css">
</head>

<body>
    <div class="form-container">
        <h2 class="text-center mb-3">añadir producto</h2>
        <form id="productoForm" action="../controllers/NuevoProducto.php" method="POST" enctype="multipart/form-data" novalidate>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
                <div class="invalid-feedback">
                    Por favor, introduce el nombre del producto.
                </div>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                <div class="invalid-feedback">
                    Por favor, introduce una descripción del producto.
                </div>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" min="0" step="0.01" required>
                <div class="invalid-feedback">
                    Por favor, introduce un precio válido (mayor o igual a 0).
                </div>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" min="0" step="1" required>
                <div class="invalid-feedback">
                    Por favor, introduce una cantidad válida de stock.
                </div>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                <div class="invalid-feedback">
                    Por favor, selecciona una imagen para el producto.
                </div>
                <div class="image-preview mt-2" id="imagePreview">
                    <div class="image-preview-placeholder">
                        <i class="bi bi-image fs-1"></i>
                        <p>Vista previa de la imagen</p>
                    </div>
                </div>
            </div>

            <button type="submit" id="submitBtn" name="Enviar" id="Enviar"  class="btn btn-primary w-100 mb-3">
                <span id="btnText">Añadir Producto</span>
                <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </form>
        <a href="./admin_productos.php" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
    </div>

    <div class="toast-container">
        <div id="resultToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="toast-body d-flex align-items-center">
                <i class="bi me-2" id="toastIcon"></i>
                <span id="toastMessage"></span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/Form.js"></script>
    </div>
</body>

</html>