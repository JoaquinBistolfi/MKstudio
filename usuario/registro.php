<?php

$conexion = mysqli_connect("localhost", "root", "", "proyecto") or die("Datos incorrectos");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usuario']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['documento']) && isset($_POST['password']) && isset($_POST['confirmar_password'])) {
        if (!empty($_POST["usuario"]) && !empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["documento"]) && !empty($_POST["password"]) && !empty($_POST["confirmar_password"])) {

            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $documento = $_POST['documento'];
            $pass = $_POST['password'];
            $confirmar_pass = $_POST['confirmar_password'];

            if ($pass !== $confirmar_pass) {
                $error = "Las contraseñas no coinciden.";
                echo '<script>alert("' . $error . '")</script>';
            } else {
                $query = "INSERT INTO `usuarios` (`usuario`, `nombre`, `apellido`, `documento`, `contrasena`) VALUES ('$usuario', '$nombre', '$apellido', '$documento', '$pass')";

                if (mysqli_query($conexion, $query)) {
                    echo '<script>alert("Se ha registrado correctamente")</script>';
                    header("Location: inicio_sesion.php");
                    exit();
                } else {
                    if (mysqli_errno($conexion) == 1062) {
                        $error = "El nombre de usuario ya existe, por favor elija otro.";
                        echo '<script>alert("' . $error . '")</script>';
                        exit();
                    } else {
                        $error = "Error en el registro: " . mysqli_error($conexion);
                        echo '<script>alert("' . $error . '")</script>';
                        exit();
                    }
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="registro.css">
    <link rel="shortcut icon" href="/imagenes/logoico.ico" type="image/x-icon">
</head>
<body>
    <header>
        <img class="header_logo" src="../imagenes/darosa.png" alt="logo de la empresa">
    </header>
    <div class="registrarse">
        <h1>Registrarse</h1>
        <form method="post">
            <div class="usuario">
                <label>Usuario</label>
                <input type="text" name="usuario" required>
            </div>
            <div class="nombre">
                <label>Nombre</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="apellido">
                <label>Apellido</label>
                <input type="text" name="apellido" required>
            </div>
            <div class="documento">
                <label>Documento</label>
                <input type="number" name="documento" required>
            </div>          
            <div class="contraseña">
                <label>Contraseña</label>
                <input type="password" name="password" required>
            </div>
            <div class="confirmar">
                <label>Confirmar contraseña</label>
                <input type="password" name="confirmar_password" required>
            </div>
            
            <input type="submit" value="Registrarse">
            <div class="inicio_sesion">
                <a href="inicio_sesion.php">Iniciar sesión</a>
            </div>
        </form>
    </div>
</body>
</html>
