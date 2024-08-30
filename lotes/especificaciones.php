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

    <H2>FORMULARIO DE DATOS</H2>
    <form action="" method="post">
        <label for="">Agregar imagenes</label>
            <img src="../imagenes/agregar.png" alt="" style="height: 30px;">
        
        <label for="">Estado:</label>
        <input type="text">
    </form>
</body>
<script>
    
</script>
</html>