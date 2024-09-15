<?php
include '../includes/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotes</title>
    <link rel="stylesheet" href="../css/lotesusr.css">
</head>
<?php include '../includes/header.php'; ?>
<body>

<h1>Lista de Lotes Disponibles</h1>

<?php
$query_lotes = "SELECT ID_Lote, Cantidad, Estado FROM lotes";
$resultado_lotes = $conexion->query($query_lotes);

if ($resultado_lotes->num_rows > 0) {
    while ($lote = $resultado_lotes->fetch_assoc()) {
        echo "<div class='lote'>";
        echo "<a href='lote.php?id_lote=" . $lote['ID_Lote'] . "'>Ver Lote " . $lote['ID_Lote'] . " - " . $lote['Cantidad'] . " animales (" . $lote['Estado'] . ")</a>";
        echo "</div>";
    }
} else {
    echo "<p>No hay lotes disponibles en este momento.</p>";
}

$conexion->close();
?>

</body>
<?php include '../includes/footer.php'; ?>
</html>
