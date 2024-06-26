<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../../css/USR.css">
    <link rel="shortcut icon" href="../../imagenes/logoico.ico" type="image/x-icon">
</head>
<body>
    <header>
        <img class="header_logo" src="../../imagenes/darosa.png" alt="logo de la empresa">
        </header>
    <div class= "registrarsediv">
        <h1>Registrarse</h1>
        <form method="post">
            
            <div class="nombrecompleto">
                <label>Nombre completo</label>
                <input type="text" required>
            </div>
            <div class="documento">
                <label>Documento</label>
                <input type="text" required>
            </div>
            <div class="domicilio">
                <label>Domicilio</label>
                <input type="text" required>
            </div>
            <div class="contraseña">
                <label> Contraseña</label>
                <input type="contraseña"required>
            </div>
            <div class="confirmar" >
                <label>Confirmar contraseña</label>
                <input type="text" required>
           </div>
            
            <input type="submit" value="Registrarse">
            <div class="inicio_sesion">
            <a href="inicio_sesion.php">Iniciar sesión</a>
            </div>
        </form>
    </div>
</body>
</html>