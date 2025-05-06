<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'lettiche');

if ($mysqli->connect_error) {
    die('Conexión fallida: ' . $mysqli->connect_error);
}

// Verificar si el código y el correo fueron proporcionados
if (isset($_GET['codigo']) && isset($_GET['correo'])) {
    $codigo = $_GET['codigo'];
    $correo = $_GET['correo'];

    // Consultar si el código existe en la base de datos
    $stmt = $mysqli->prepare("SELECT * FROM recuperacion WHERE codigo = ? AND correo = ?");
    $stmt->bind_param("ss", $codigo, $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Si el código y el correo existen, mostrar el formulario para cambiar la contraseña
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recibir y asegurar que la nueva contraseña se haya proporcionado
            $nueva_contraseña = $_POST['nueva_contraseña'];

            // Asegurarse de que la nueva contraseña no esté vacía
            if (!empty($nueva_contraseña)) {
                // Actualizar la contraseña en la base de datos (esto debe ser una operación segura, usando hash)
                $nueva_contraseña_hash = password_hash($nueva_contraseña, PASSWORD_BCRYPT);
                $stmt = $mysqli->prepare("UPDATE usuarios SET pass = ? WHERE correo = ?");
                $stmt->bind_param("ss", $nueva_contraseña_hash, $correo);
                $stmt->execute();

                // Eliminar el código de recuperación una vez que la contraseña haya sido cambiada
                $stmt = $mysqli->prepare("DELETE FROM recuperacion WHERE codigo = ? AND correo = ?");
                $stmt->bind_param("ss", $codigo, $correo);
                $stmt->execute();

                // Mostrar un mensaje de éxito y evitar que se muestre el formulario nuevamente
                echo 'Contraseña cambiada con éxito.';
            } else {
                echo 'Por favor, ingrese una nueva contraseña.';
            }
        } else {
            // Mostrar el formulario para cambiar la contraseña
            echo '<form method="post">
                    <label for="nueva_contraseña">Nueva Contraseña:</label>
                    <input type="password" id="nueva_contraseña" name="nueva_contraseña" required>
                    <button type="submit">Cambiar Contraseña</button>
                  </form>';
        }
    } else {
        // Si el código o el correo no existen, mostrar un mensaje de error
        echo 'El código de recuperación no existe o ha expirado.';
    }
}

$mysqli->close();
?>
