<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "proyecto") or die("Datos incorrectos");

if (isset($_POST['usuario']) && isset($_POST['password'])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["password"])) {
        $usr = $_POST["usuario"];
        $pass = $_POST["password"];

        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE Usuario = ? AND Contrasena = ?");
        $stmt->bind_param('ss', $usr, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $_SESSION['user_id'] = $user['ID_Usuario'];
            $_SESSION['username'] = $user['usuario'];
            header("Location: main.php");
            exit();
        } else {
            echo '<p>Nombre de usuario o contraseña incorrectos.</p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="shortcut icon" href="../imagenes/logoico.ico" type="image/x-icon">
</head>
<body>
    <header>
        <img class="header_logo" src="../imagenes/darosa.png" alt="logo de la empresa">
    </header>
    <div class="registro">
        <h1>Iniciar sesión</h1>
        <form method="post">
            <label>Nombre de usuario</label>
            <input type="text" name='usuario' required>
            <label>Contraseña</label>
            <input type="password" name='password' required>
            <div class="recordar">
                <a href="#">¿Olvidó su contraseña?</a>
            </div>
            <input type="submit" value="Iniciar Sesión">
            <div>
                <a href="registro.php">¿No tiene una cuenta? Clic aqui</a>
            </div>
        </form>
    </div>
</body>
</html>
