<?php
require_once '../models/MySQL.php';

$mysql = new MySQL;
$mysql->conectar();



if (
    $_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['Enviar'])
) {

    //obtenemos los datos del formulario
    $telefono = trim(filter_input(INPUT_POST, 'telefono', FILTER_VALIDATE_INT)); //$_POST['telefono'];
    $correo = trim(filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL)); //$_POST['correo'];
    $contrasena = $_POST['contrasena'];


    if (empty($correo) || empty($telefono) || empty($contrasena)) {
        echo "Por favor, complete todos los campos.";

        exit;
    }

    //validamos el telefono
    if (strlen($telefono) < 10 || strlen($telefono) > 15) {
        echo "El telefono no es valido.";
        exit;
    }
    //validamos el correo
    if (filter_var($correo, FILTER_VALIDATE_EMAIL) === false) {
        echo "El correo no es valido.";
        exit;
    }


    $resultado = $mysql->efectuarConsulta("SELECT
    id, Correo,cargo,pass 
    FROM usuarios 
    WHERE correo = '$correo' 
    and telefono = '$telefono'");

    $hash = password_hash($contrasena, PASSWORD_BCRYPT);

    if ($usuario = mysqli_fetch_assoc($resultado)) {
        // Se verifica que la contraseña coincida con el hash
        if (password_verify($contrasena, $usuario['pass'])) {
            // Si la contraseña es correcta, se inicia la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['correo'] = $usuario['Correo'];
            $mysql->desconectar();
            header("refresh:3;url= ../views/ecomers.php");
            exit();
        }
    }
    // Si el login falla, se redirige nuevamente al formulario
    $mysql->desconectar();
    header("Location: ../views/login.php?error=1");
    exit();
} else {
    // Si los campos están vacíos, también se redirige
    header("Location: ../views/login.php?error=1");
    exit();
}
echo "Empleado creado con exito";


$mysql->desconectar();

header("refresh:3;url= ../views/ecomers.php");
exit();
