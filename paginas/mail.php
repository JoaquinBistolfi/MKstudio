<?php
include '../includes/conexion.php';
session_start();

if ($_SESSION['mail'] == "nuevolote") {
    $sql = "SELECT Email FROM usuarios";
    $result = $conexion->query($sql);

    $sql2 = "SELECT * FROM lotes ORDER BY ID_Lote DESC LIMIT 1";
    $result2 = $conexion->query($sql2);

    if ($result2 && mysqli_num_rows($result2) > 0) {
        $lote = $result2->fetch_assoc();
    } else {
        echo "No hay lotes disponibles.";
        exit;  
    }

    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $email = $row['Email'];
            enviarCorreo($email, $lote); 
        }
    } else {
        echo "No hay usuarios registrados.";
    }
}

function enviarCorreo($para, $lote) {
    $asunto = "Nuevo lote publicado.";
    $mensaje = "Categoría: " . $lote['Categoria'] . "<br> Cantidad: " . $lote['Cantidad'] . "<br> Peso: " . $lote['Peso_Prom'] . "<br> Descripción: " . $lote['Observaciones'];
    $cabeceras = "From: mkstudio3be@gmail.com\r\n";
    $cabeceras .= "Reply-To: mkstudio3be@gmail.com\r\n";
    $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

    if (mail($para, $asunto, $mensaje, $cabeceras)) {
        echo "Correo enviado a: $para<br>";
    } else {
        echo "No se pudo enviar el correo a: $para<br>";
    }
}
?>
