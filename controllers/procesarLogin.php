<?php
session_start();
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


    if (empty($correo) && empty($telefono) && empty($contrasena)) {
        header("Location: ../views/Login.php?error=99");
        exit();
    }

    //validamos el telefono
    if (strlen($telefono) < 10 || strlen($telefono) > 15) {
        header("Location: ../views/Login.php?error=101");
        exit();
    }
    //validamos el correo
    if (filter_var($correo, FILTER_VALIDATE_EMAIL) === false) {
        header("Location: ../views/Login.php?error=102");
        exit();
    }


    $resultado = $mysql->efectuarConsulta("SELECT id, Correo, cargo, pass 
    FROM usuarios WHERE correo = '$correo' 
    and telefono = '$telefono' and estado = 'ACTIVO'");

    $hash = password_hash($contrasena, PASSWORD_BCRYPT);

    if ($usuario = mysqli_fetch_assoc($resultado)) {
        // Se verifica que la contraseña coincida con el hash
        if (password_verify($contrasena, $usuario['pass'])) {
            // Si la contraseña es correcta, se inicia la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['correo'] = $usuario['Correo'];
            $_SESSION['cargo'] = $usuario['cargo'];
            $mysql->desconectar();

            echo '
            <html>
            <head>
                <style>
                    .loader-container {
                        position: fixed;    
                        top: 0;
                        left: 0;
                        width: 100vw;   
                        height: 100vh;        
                        display: flex;   
                        justify-content: center; 
                        align-items: center;     
                        background: rgba(255, 255, 255, 0.8); 
                        z-index: 9999;         
}


                    .loader {
                        --dim: 3rem;
                        width: var(--dim);
                        height: var(--dim);
                        position: relative;
                        animation: spin988 2s linear infinite;
                        }

                    .loader .circle {
                        --color: #333;
                        --dim: 1.2rem;
                        width: var(--dim);
                        height: var(--dim);
                        background-color: var(--color);
                        border-radius: 50%;
                        position: absolute;
                        }

                    .loader .circle:nth-child(1) {
                        top: 0;
                        left: 0;
                        }

                    .loader .circle:nth-child(2) {
                        top: 0;
                        right: 0;
                        }

                    .loader .circle:nth-child(3) {
                        bottom: 0;
                        left: 0;
                        }

                    .loader .circle:nth-child(4) {
                        bottom: 0;
                        right: 0;
                        }
            
                    @keyframes spin988 {
                        0% {
                            transform: scale(1) rotate(0);
                        }

                        20%, 25% {
                            transform: scale(1.3) rotate(90deg);
                        }

                        45%, 50% {
                            transform: scale(1) rotate(180deg);
                        }

                        70%, 75% {
                            transform: scale(1.3) rotate(270deg);
                        }

                        95%, 100% {
                            transform: scale(1) rotate(360deg);
                        }
                        }
                </style>
            </head>
            <body>
                <div class="loader-container">
                    <div class="loader">
                        <div class="circle"></div>
                        <div class="circle"></div>
                        <div class="circle"></div>
                        <div class="circle"></div>
                    </div>
                </div>
            </body>
            </html>
            ';




            if ($usuario['cargo'] === 'ADMIN') {
                header("refresh:3;url= ../admin/admin_index.php");
            } else {
                header("refresh:3;url= ../views/index.php");
            }
            exit();
        } else {
            header("Location: ../views/Login.php?error=1");
            exit();
        }
    }
    // Si el login falla, se redirige nuevamente al formulario
    $mysql->desconectar();
    header("Location: ../views/Login.php?error=1");
    exit();
} else {
    // Si los campos están vacíos, también se redirige
    header("Location: ../views/Login.php?error=1");
    exit();
}
echo "Usuario Ingresado Exitosamente";


$mysql->desconectar();

header("refresh:3;url= ../views/index.php");
exit();
