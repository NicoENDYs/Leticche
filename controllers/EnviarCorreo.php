<?php
// Incluir las clases necesarias
require_once 'Correo.php';

// Verificamos si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibimos los datos del formulario
    $correoDestino = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);

    // Verificamos que la dirección de correo sea válida
    if (filter_var($correoDestino, FILTER_VALIDATE_EMAIL)) {
        // Instanciamos la clase Correo
        $correo = new Correo();

        // Llamamos al método para manejar la recuperación de contraseña
        $correo->recuperarContrasena($correoDestino);  // Este método se encarga de todo el flujo
    } else {
        echo "La dirección de correo no es válida.";
    }
} else {
    echo "No se ha enviado el formulario.";
}
?>
