<?php
// Incluir las clases necesarias
require_once 'Correo.php';

// Verificamos si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibimos los datos del formulario
    $correoDestino = filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL) ? $_POST['correo'] : "El correo '" . $_POST['correo'] . "' es invalido";
    $correoDestino = filter_var($correoDestino, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // Verificamos que la dirección de correo sea válida
    if (filter_var($correoDestino, FILTER_VALIDATE_EMAIL)) {
        // Instanciamos la clase Correo
        $correo = new Correo();

        // Llamamos al método para manejar la recuperación de contraseña
        $correo->recuperarContrasena($correoDestino);  // Este método se encarga de todo el flujo
    } else {
        echo $correoDestino;
    }
} else {
    echo "No se ha enviado el formulario.";
}
?>
