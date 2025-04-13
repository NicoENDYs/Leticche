<?php   
    require_once '../models/MySQL.php';

    $mysql = new MySQL;
    $mysql->conectar();



    if ($_SERVER['REQUEST_METHOD'] == 'POST' 
    && isset($_POST['Enviar'])) {

    //obtenemos los datos del formulario
    $nombre = trim(filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $correo = trim(filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL));//$_POST['correo'];
    $telefono = trim(filter_input(INPUT_POST, 'telefono', FILTER_VALIDATE_INT));//$_POST['telefono'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];



    if (empty($nombre)   || empty($correo) || 
        empty($telefono) || empty($contrasena) || 
        empty($confirmar_contrasena)) {
            echo "Por favor, complete todos los campos.";
            
            exit;
        }
        

        if ($contrasena !== $confirmar_contrasena) {
            echo "Las contraseñas no coinciden.";
            exit;
        }
        else{
            $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
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

        //////////////////////////////////VALIDACION CORREO NO SE REPITA/////////////////////////////////////////////////
        $consulta_verificacion = "SELECT id FROM usuarios WHERE Correo = '$correo'";
        $resultado = $mysql->efectuarConsulta($consulta_verificacion);
        
        if ($resultado && $resultado->num_rows > 0) {
            echo "El correo electrónico ya está registrado por otro empleado.";
            exit;
        }
        //////////////////////////////////VALIDACION CORREO NO SE REPITA/////////////////////////////////////////////////

        //////////////////////////////////VALIDACION documento NO SE REPITA/////////////////////////////////////////////////
        $consulta_verificacion = "SELECT id FROM usuarios WHERE telefono = '$telefono'";
        $resultado = $mysql->efectuarConsulta($consulta_verificacion);

        if ($resultado && $resultado->num_rows > 0) {
            echo "El documento ya está registrado por otro empleado.";  
        
        exit;
        }
        //////////////////////////////////VALIDACION documento NO SE REPITA/////////////////////////////////////////////////    
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
            echo "Empleado creado con exito";        

            $mysql->desconectar();
                            
            header("refresh:3;url= ../views/ecomers.php");
            exit();



    }
    ?>