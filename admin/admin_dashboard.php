<?php
session_start();
require_once '../models/MySQL.php';
$mysql = new MySQL;
$mysql->conectar();


$resultado = $mysql->efectuarConsulta("
SELECT id, nombre, correo, telefono, cargo, Estado 
FROM usuarios 
WHERE cargo = 'USER'");


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
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Cargo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($usuarios = mysqli_fetch_assoc($resultado)): ?>
                                <tr>
                                    <td><?php echo $usuarios['id']; ?></td>
                                    <td><?php echo $usuarios['nombre']; ?></td>
                                    <td><?php echo $usuarios['correo']; ?></td>
                                    <td><?php echo $usuarios['telefono']; ?></td>
                                    <td><?php echo $usuarios['cargo']; ?></td>                                    
                                    <td><?php echo $usuarios['Estado']; ?></td>
                                    <td>
                                        <a href="editar_empleado.php?id=<?php echo $usuarios['id']; ?>">Editar</a> |
                                        <a href="../controllers/eliminarUsuario.php?id=<?php echo $usuarios['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
                                    </td>
                                </tr>

                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No hay empleados registrados.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>



</html>