<?php
include '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usuario']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['telefono']) && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['confirmar_password'])) {
        if (!empty($_POST["usuario"]) && !empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["telefono"]) && !empty($_POST["password"]) && !empty($_POST["confirmar_password"])) {

            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $telefono = $_POST['telefono'];
            $mail = $_POST['mail'];
            $pass = $_POST['password'];
            $confirmar_pass = $_POST['confirmar_password'];

            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                echo '<p>Por favor ingrese un correo electrónico válido.</p>';
            }elseif ($pass !== $confirmar_pass) {
                echo '<p>Las contraseñas no coinciden.</p>';
            } else {
                $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $query = "INSERT INTO `usuarios` (`usuario`, `nombre`, `apellido`, `telefono`, `mail`, `contrasena`) VALUES ('$usuario', '$nombre', '$apellido', '$telefono', '$mail', '$pass')";
                if (mysqli_query($conexion, $query)) {
                    header("Location: inicio_sesion.php");
                    exit();
                } else {
                    if (mysqli_errno($conexion) == 1062) {
                        echo '<p>El nombre de usuario o mail ya existe, por favor elija otro.</p>';
                    } else {
                        echo '<script>alert("Error en el registro: ' . mysqli_error($conexion) . '")</script>';
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
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="shortcut icon" href="../imagenes/logoico.ico" type="image/x-icon">
</head>
<body>
    <header>
    <a href="../index.php"><img class="header_logo" src="../imagenes/darosa.png" alt="logo de la empresa"></a>
    </header>
    <div class="registro">
        <h1>Registrarse</h1>
        <form method="post">
            <label>Usuario</label>
            <input type="text" name="usuario" required>
            <label>Nombre</label>
            <input type="text" name="nombre" required>
            <label>Apellido</label>
            <input type="text" name="apellido" required>
            <label>Telefono</label>
            <input type="number" name="telefono" required>
            <label>Mail</label>
            <input type="text" name="mail" required>
            <label>Contraseña</label>
            <input type="password" name="password" required>
            <label>Confirmar contraseña</label>
            <input type="password" name="confirmar_password" required>
            <input type="submit" value="Registrarse">
            <div>
                <a href="inicio_sesion.php">¿Ya tienes cuenta? Clic aqui</a>
            </div>
        </form>
    </div>
</body>
</html>