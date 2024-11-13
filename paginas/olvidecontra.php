<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="shortcut icon" href="../imagenes/logoico.ico" type="image/x-icon">
</head>
<body>
    <header>
        <a href="../index.php"><img class="header_logo" src="../imagenes/darosa.png" alt="logo de la empresa"></a>
    </header>
    <div class="registro">
        <form action="recuperar_contrasena.php" method="POST">
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" required placeholder="Introduce tu correo electrónico">
            <input type="submit" value="Restablecer Contraseña">
        </form>
    </div>
</body>
</html>
