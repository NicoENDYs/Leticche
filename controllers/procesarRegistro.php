<?php
require_once '../models/MySQL.php';

$mysql = new MySQL;
$mysql->conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Enviar'])) {

    //verificamos la existencia de los campos
    if (isset($_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['contrasena'], $_POST['confirmar_contrasena'])) {

        //obtenemos los datos del formulario antes de validar o sanitizar
        $nombre = trim($_POST['nombre']);
        $correo = trim($_POST['correo']);
        $telefono = trim($_POST['telefono']);
        $contrasena = trim($_POST['contrasena']);
        $confirmar_contrasena = trim($_POST['confirmar_contrasena']);

        if (empty($nombre) || empty($correo) ||
            empty($telefono) || empty($contrasena) ||
            empty($confirmar_contrasena)) {
            echo "Por favor, complete todos los campos.";
            exit;
        }

        function validar($nombreCampo, $valorCampo, $validar){
            if($validar === "invalido"){
                echo "El $nombreCampo '$valorCampo' es invalido";
                exit;
            }
        }

        //patrones validos 
        $patronValidoTexto = '/^[\p{L} ]+$/u'; //permite caracteres de diferentes idiomas y acentos
        $patronValidoTelefono = '/^\d{10}+$/'; //permite los numeros del 0 al 9 con un limite de 10 digitos

        //validaciones
        $nombre = preg_match($patronValidoTexto, $nombre) ? $nombre : validar("nombre", $nombre, "invalido");
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL) ? $correo : validar("correo", $correo, "invalido");
        $telefono = preg_match($patronValidoTelefono, $telefono) ? $telefono : validar("telefono", $telefono, "invalido");
        $contrasena = $_POST['contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];

        if ($contrasena !== $confirmar_contrasena) {
            echo "Las contraseñas no coinciden.";
            exit;
        } else {
            $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        }
        

        //////////////////////////////////VALIDACION CORREO NO SE REPITA/////////////////////////////////////////////////
        $consulta_verificacion = "SELECT id FROM usuarios WHERE Correo = '$correo'";
        $resultado = $mysql->efectuarConsulta($consulta_verificacion);

        if ($resultado && $resultado->num_rows > 0) {
            echo "El correo electrónico ya está registrado por otro usuario.";
            exit;
        }
        //////////////////////////////////VALIDACION CORREO NO SE REPITA/////////////////////////////////////////////////

        //////////////////////////////////VALIDACION telefono NO SE REPITA/////////////////////////////////////////////////
        $consulta_verificacion = "SELECT id FROM usuarios WHERE telefono = '$telefono'";
        $resultado = $mysql->efectuarConsulta($consulta_verificacion);

        if ($resultado && $resultado->num_rows > 0) {
            echo "El documento ya está registrado por otro usuario.";

            exit;
        }
        //////////////////////////////////VALIDACION telefono NO SE REPITA/////////////////////////////////////////////////    
        //validamos el nombre
        if (strlen($nombre) < 5 || strlen($nombre) > 50) {
            echo "El nombre no es valido.";
            exit;
        }




        //insertar en base de datos 
        $consulta = "INSERT INTO usuarios 
            (nombre, correo, telefono, cargo, pass)
            VALUES 
            ('$nombre', '$correo', '$telefono', 'user', '$contrasena')";
        $mysql->efectuarConsulta($consulta);
        echo "Usuario creado con exito, ahora iniciando sesion...";
        // Iniciar sesión y redirigir al usuario a la página de inicio         
        $mysql->desconectar();

        header("refresh:3;url= ../views/login.php");
        exit();
    } else {
        echo "Algún campo es inexistente";
    }
} else {
    echo "Metodo de envio invalido";
}
?>