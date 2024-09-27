<?php
$conexion = mysqli_connect("localhost", "root", "", "proyecto");

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}


$sql = "SELECT ID_Lote, Categoria, Cantidad_Raza, Cantidad, Peso_Prom, Ruta_archivo FROM lotes";
$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Ofertas</title>
    <link rel="stylesheet" href="../css/lotes.css">
</head>
<?php include '../includes/header.php'; ?>
<body>

    <h2>Lista de lotes subidos</h2>
    <table class="listas">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Raza</th>
                <th>Cantidad</th>
                <th>Peso</th>
                <th>Tu Ultima Oferta</th>
                <th>Mayor Oferta</th>
            </tr>
        </thead>
        <tbody>
        <div class="fila_tabla">
        <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><a href='especificaciones.php?id=" . $row['ID_Lote'] . "'><img src='" . $row['Ruta_archivo'] . "' alt='" . $row['Categoria'] . "'></a></td>";  
                    echo "<td>" . $row['Cantidad_Raza'] . "</td>";
                    echo "<td>" . $row['Cantidad'] . "</td>";
                    echo "<td>" . $row['Peso_Prom'] . "</td>";
                    echo "<td>" . $row['Oferta_Usr'] . "</td>";
                    echo "<td>" . $row['Mayor_Oferta'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "No se encontraron lotes.";
            }
            ?>
        </div>
        </tbody>
    </table>
</body>
<?php include '../includes/footer.php'; ?>
</html>