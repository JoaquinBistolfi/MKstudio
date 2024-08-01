<?php

$conexion = mysqli_connect("localhost", "root", "", "proyecto") or die("Datos incorrectos");

$query = "SELECT * FROM `lotes` WHERE `titulo` LIKE '1 joaquin bien perritp'";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="especificaciones.css">
</head>
<body>
    <h1>Espcecificaciones del lote</h1>

    <div class="datos">
        <div class="img_vaca">
                <ul>
                    <li><img src="../imagenes/loteangus.webp" alt=""></li>
                    <li><img src="../imagenes/lotebraford.jpg" alt=""></li>
                    <li><img src="../imagenes/lotepampa.jpeg" alt=""></li>
                    <li><img src="../imagenes/novillonegro.jpg" alt=""></li>
                    <li><img src="../imagenes/gandado.jpg" alt=""></li>
                </ul>
        </div>
        <div id="messages"></div>
    </div>
</body>
<script>
    
</script>
</html>