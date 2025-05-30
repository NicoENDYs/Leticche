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
                header('refresh:3;url=../views/Login.php?mensaje=Contrasena_cambiada');
            } else {
                echo 'Por favor, ingrese una nueva contraseña.';
            }
        } else {
            // Mostrar el formulario para cambiar la contraseña
            echo '
            <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Envío de Correo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../styles/LoginRegis.css">

</head>

<body>
    <div class="form-container">
        <h2 class="text-center mb-3">Formulario de Envío de Correo</h2>
        <form method="post">
            <div class="mb-3">
                <label for="nueva_contraseña" class="form-label">Nueva Contraseña:</label>
                <input type="password" class="form-control" id="nueva_contraseña" name="nueva_contraseña" required>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary w-100">Cambiar Contraseña</button>
        </form>
    </div>
</body>

</html>
        ';
        }
    } else {
        
        // Si el código o el correo no existen, mostrar un mensaje de error
        header('refresh:3;url=../views/Login.php?mensaje=Codigo_invalido');
    }
}

$mysqli->close();
?>
