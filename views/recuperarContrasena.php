<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Envío de Correo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/LoginRegis.css">

</head>
<body>
    <div class="form-container">
    <h2 class="text-center mb-3">Formulario de Envío de Correo</h2>
    <form action="../controllers/enviarCorreo.php" method="POST">
    <div class="mb-3">
        <label for="correo" class="form-label ">Correo electrónico:</label><BR></BR>
        <input type="email" class="form-control" id="correo" name="correo" required>
    </div>
        <br><br>
        <button type="submit" class="btn btn-primary w-100">Enviar</button>
    </form>
    </div>
</body>
</html>
