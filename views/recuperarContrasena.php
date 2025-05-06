<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Envío de Correo</title>
</head>
<body>
    <h2>Formulario de Envío de Correo</h2>
    <form action="../controllers/enviarCorreo.php" method="POST">
        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" required>
        <br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
