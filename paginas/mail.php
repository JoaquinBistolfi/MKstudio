<?php
include '../includes/conexion.php';

function enviarCorreo($to, $subject, $message) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@tudominio.com" . "\r\n";

    return mail($to, $subject, $message, $headers);
}

$sql_usuarios = "SELECT mail FROM usuarios";
$result_usuarios = mysqli_query($conexion, $sql_usuarios);

if ($result_usuarios && mysqli_num_rows($result_usuarios) > 0) {
    while ($row = mysqli_fetch_assoc($result_usuarios)) {
        $email = $row['mail'];

        $subject = "Nuevo Lote Publicado";
        $message = "
        <html>
        <head>
        <title>Nuevo Lote</title>
        </head>
        <body>
        <h2>¡Nuevo lote disponible!</h2>
        <p>Un nuevo lote ha sido publicado en nuestra plataforma.</p>
        <p><strong>Categoría:</strong> {$_POST['categoria']}</p>
        <p><strong>Cantidad:</strong> {$_POST['cantidad']}</p>
        <p><strong>Peso Promedio:</strong> {$_POST['peso']}</p>
        <p><strong>Raza:</strong> {$_POST['raza']}</p>
        <p><a href='http://.com/lotes.php'>Ver el lote completo</a></p> 
        </body>
        </html>
        ";// falta poner la url de nueswtra pagina cuando quede subida

        enviarCorreo($email, $subject, $message);
    }
} else {
    echo "No se encontraron usuarios para enviar el correo.";
}
?>
