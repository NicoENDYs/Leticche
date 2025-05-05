<?php
require '../vendor/autoload.php';  // Incluye PHPMailer si usas Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Función para generar un código aleatorio de 20 caracteres
function generarCodigo()
{
    return bin2hex(random_bytes(10));  // Genera un código de 20 caracteres hexadecimales
}

class Correo
{

    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    // Función para enviar el correo con el enlace de recuperación
    public function enviarCorreo($destinatario, $asunto, $mensaje)
    {
        try {
            // Configuración del servidor SMTP de Gmail
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com';  // Dirección SMTP de Gmail
            $this->mail->SMTPAuth = true;
            $this->mail->Username = 'jadiazosorio1@gmail.com';  // Tu correo SMTP
            $this->mail->Password = 'ublm atgk aawz vlbn';  // Contraseña de la aplicación para Gmail
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;

            // Remitente
            $this->mail->setFrom('jadiazosorio1@gmail.com', 'Prueba de correo');
            // Destinatario
            $this->mail->addAddress($destinatario);

            // Contenido del correo
            $this->mail->isHTML(true);
            $this->mail->Subject = $asunto;
            $this->mail->Body = $mensaje;

            // Enviar el correo
            $this->mail->send();
            echo 'El mensaje ha sido enviado.';
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$this->mail->ErrorInfo}";
        }
    }

    // Función para manejar la recuperación de contraseña
    public function recuperarContrasena($correo)
    {
        // Conectar a la base de datos
        $mysqli = new mysqli('localhost', 'root', '', 'lettiche');

        // Verificar la conexión
        if ($mysqli->connect_error) {
            die('Conexión fallida: ' . $mysqli->connect_error);
        }

        // Generar el código de recuperación
        $codigo = generarCodigo();

        // Verifica y elimina si existe
        $stmt = $mysqli->prepare("DELETE FROM recuperacion WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->close();

        // Inserta el nuevo valor
        $stmt = $mysqli->prepare("INSERT INTO recuperacion (correo, codigo) VALUES (?, ?)");
        $stmt->bind_param("ss", $correo, $codigo);
        $stmt->execute();
        $stmt->close();


        // Crear el enlace con el código de recuperación
        $enlace = "http://localhost/Email_ejemplo/recuperar.php?codigo=" . $codigo . "&correo=" . urlencode($correo);

        // Enviar el correo con el enlace de recuperación
        $asunto = 'Recuperación de Contraseña';
        $mensaje = "Haz clic en el siguiente enlace para recuperar tu contraseña: <a href='" . $enlace . "'>Recuperar Contraseña</a>";

        // Llamar a la función de enviarCorreo
        $this->enviarCorreo($correo, $asunto, $mensaje);

        $mysqli->close();
    }
}
?>