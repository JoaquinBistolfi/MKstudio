<?php
include '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];
    $sql = "SELECT id_usuario FROM usuarios WHERE mail = '$email'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        function generarCadenaAleatoria($longitud = 8) {
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
            $cadenaAleatoria = '';
            for ($i = 0; $i < $longitud; $i++) {
                $cadenaAleatoria .= $caracteres[random_int(0, strlen($caracteres) - 1)];
            }
            return $cadenaAleatoria;
        }

        $codigo = generarCadenaAleatoria();
        $codigoHash = password_hash($codigo, PASSWORD_BCRYPT);
        $sqlUpdate = "UPDATE usuarios SET contrasena = '$codigoHash' WHERE mail = '$email'";
        mysqli_query($conexion, $sqlUpdate);

        $link = "http://darosa.site/paginas/restablecer_contrasena.php?email=" . urlencode($email) . "&code=" . urlencode($codigo);

        $asunto = "Restablecer tu contraseña";
        $mensaje = "Tu código temporal es $codigo. Haz clic en el siguiente enlace para restablecer tu contraseña: $link";
        $headers = "From: no-reply@darosa.site\r\n";

        if (mail($email, $asunto, $mensaje, $headers)) {
            echo "<div class='message success'>Te hemos enviado un enlace para restablecer tu contraseña a tu correo electrónico.</div>";
        } else {
            echo "<div class='message error'>Hubo un error al enviar el correo.</div>";
        }
    } else {
        echo "<div class='message error'>El correo electrónico no se encuentra registrado.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandar mail</title>
    <link rel="stylesheet" href="../css/contra.css">
</head>
<body>
    
</body>
</html>