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
    <link rel="stylesheet" href="../styles/admin.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mt-5 text-black">ADMIN DASHBOARD</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center mt-5 text-black">
                    Usuarios Registrados
                </h3>

                <?php if (mysqli_num_rows($resultado) > 0): ?>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Estado</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
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
                                    <td><?php echo $productos['Estado']; ?></td>
                                    <td><img src="../img/<?php echo $productos['imagen']; ?>" width="100" height="80"></td>
                                    <td>
                                        <a href="editar_empleado.php?id=<?php echo $productos['id']; ?>">Editar</a> |
                                        <a href="../controllers/EliminarProducto.php?id=<?php echo $productos['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este Producto?');">Eliminar</a>
                                    </td>
                                </tr>

                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center mt-5 text-black">No hay productos registrados.</p>
                <?php endif; ?>
                <a href="../admin/admin_NuevoProducto.php">
                    <button type="button" class="btn btn-info w-100 fw-bold text-light">Añadir Prodcto</button>
                </a>
            </div>
        </div>
    </div>

</body>



</html>