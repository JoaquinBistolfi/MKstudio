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

        $link = "http://tusitio.com/restablecer_contrasena.php?email=" . urlencode($email) . "&code=" . urlencode($codigo);

        $asunto = "Restablecer tu contraseña";
        $mensaje = "Tu código temporal es $codigo. Haz clic en el siguiente enlace para restablecer tu contraseña: $link";
        $headers = "From: no-reply@tusitio.com\r\n";

        if (mail($email, $asunto, $mensaje, $headers)) {
            echo "Te hemos enviado un enlace para restablecer tu contraseña a tu correo electrónico.";
        } else {
            echo "Hubo un error al enviar el correo.";
        }
    } else {
        echo "El correo electrónico no se encuentra registrado.";
    }
}
?>