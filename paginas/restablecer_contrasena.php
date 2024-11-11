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
        <a href="index.php"><img class="header_logo" src="../imagenes/darosa.png" alt="logo de la empresa"></a>
    </header>
    <div class="registro">
        <h1>Restablecer tu Contraseña</h1>
        <form action="restablecer_contrasena.php" method="POST">
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
            <input type="hidden" name="code" value="<?php echo $_GET['code']; ?>">
            <label for="contrasena">Nueva Contraseña:</label>
            <input type="password" name="contrasena" required placeholder="Introduce tu nueva contraseña">
            <input type="submit" value="Restablecer Contraseña">
        </form>
    </div>
</body>
</html>

<?php
include '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $code = $_POST['code'];
    $nueva_contrasena = $_POST['contrasena'];

    $sql = "SELECT contrasena FROM usuarios WHERE mail = '$email'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($code, $row['contrasena'])) {
            $contrasenaHash = password_hash($nueva_contrasena, PASSWORD_BCRYPT);
            $sqlUpdate = "UPDATE usuarios SET contrasena = '$contrasenaHash' WHERE mail = '$email'";
            mysqli_query($conexion, $sqlUpdate);
            echo "Tu contraseña ha sido restablecida exitosamente.";
        } else {
            echo "El código de restablecimiento no es válido.";
        }
    } else {
        echo "El correo electrónico no se encuentra registrado.";
    }
}
?>
