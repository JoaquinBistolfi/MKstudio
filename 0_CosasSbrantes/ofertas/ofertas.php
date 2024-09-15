<?php
$conexion = mysqli_connect("localhost", "root", "", "proyecto");

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

// Falta agregar en la base de datos el tiempo limite para hacer ofertas y obtener el id del usaurio atravez de la session para obtener sus ofertas.
$sql = "SELECT oferta.Monto, lotes.Categoria, lotes.Cantidad, lotes.Peso_Prom, lotes.Ruta_archivo FROM lotes, oferta, usuarios WHERE lotes.ID_Lote=oferta.ID_Lote AND usuarios.ID_Usuario=";
$result = mysqli_query($conexion, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Ofertas</title>
    <link rel="stylesheet" href="ofertas.css">
</head>
<body>

</body>
</html>