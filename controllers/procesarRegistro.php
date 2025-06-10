<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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

        $datos_url = http_build_query([
            'nombre' => $nombre,
            'correo' => $correo,
            'telefono' => $telefono
        ]);

        // Validación de campos vacíos
        if (empty($nombre) || empty($correo) ||
            empty($telefono) || empty($contrasena) ||
            empty($confirmar_contrasena)) {
            
            $errorCode = "100_campos_vacios";
            header("Location: ../views/Registro.php?error=$errorCode&$datos_url");
            exit();
        }

        if(strlen($telefono) < 10 || strlen($telefono) > 10){
            $errorCode = "120_telefono_invalido";
            header("Location: ../views/Registro.php?error=$errorCode&$datos_url");
            exit();
        }

        // Función de validación mejorada (recibe $datos_url como parámetro)
        function validar($nombreCampo, $valorCampo, $validar, $datos_url){
            if($validar === "invalido"){
                $errorCode = "120_" . urlencode($nombreCampo) . "_" . urlencode($valorCampo);
                header("Location: ../views/Registro.php?error=$errorCode&$datos_url");
                exit();
            }
        }

        //patrones validos 
        $patronValidoTexto = '/^[\p{L} ]+$/u'; //permite caracteres de diferentes idiomas y acentos
        $patronValidoTelefono = '/^\d{10}$/'; //permite los numeros del 0 al 9 con un limite de 10 digitos

        //validaciones
        $nombre = preg_match($patronValidoTexto, $nombre) ? $nombre : validar("nombre", $nombre, "invalido", $datos_url);
        $correo = filter_var($correo, FILTER_VALIDATE_EMAIL) ? $correo : validar("correo", $correo, "invalido", $datos_url);
        $telefono = preg_match($patronValidoTelefono, $telefono) ? $telefono : validar("telefono", $telefono, "invalido", $datos_url);
        $contrasena = $_POST['contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];

        if ($contrasena !== $confirmar_contrasena) {
            header("Location: ../views/Registro.php?error=99&$datos_url");
            exit();
        } else {
            $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        }
        
        //////////////////////////////////VALIDACION CORREO NO SE REPITA/////////////////////////////////////////////////
        $consulta_verificacion = "SELECT id FROM usuarios WHERE Correo = '$correo'";
        $resultado = $mysql->efectuarConsulta($consulta_verificacion);

        if ($resultado && $resultado->num_rows > 0) {
            header("Location: ../views/Registro.php?error=100&$datos_url");
            exit();
        }
        //////////////////////////////////VALIDACION CORREO NO SE REPITA/////////////////////////////////////////////////

        //////////////////////////////////VALIDACION telefono NO SE REPITA/////////////////////////////////////////////////
        $consulta_verificacion = "SELECT id FROM usuarios WHERE telefono = '$telefono'";
        $resultado = $mysql->efectuarConsulta($consulta_verificacion);

        if ($resultado && $resultado->num_rows > 0) {
            header("Location: ../views/Registro.php?error=101&$datos_url");
            exit();
        }
        //////////////////////////////////VALIDACION telefono NO SE REPITA/////////////////////////////////////////////////




        //insertar en base de datos 
        $consulta = "INSERT INTO usuarios 
            (nombre, correo, telefono, cargo, pass,direccion)
            VALUES 
            ('$nombre', '$correo', '$telefono', 'user', '$contrasena','')";
        $mysql->efectuarConsulta($consulta);
        
        // Iniciar sesión y redirigir al usuario a la página de inicio         
        $mysql->desconectar();
        header("Location: ../views/Login.php?info=111");
        exit();
    } else {
        header("Location: ../views/Registro.php?error=102");
            exit();
    }
} else {
    echo "Metodo de envio invalido";
}
?>