<?php
include '../includes/conexion.php';

$sql = "SELECT * FROM pregunta p, usuarios u WHERE p.id_usuario = u.id_usuario AND estado = 'pendiente';";
$result = mysqli_query($conexion, $sql);
if (!$result) {
    die("Error en la consulta SQL: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>
    <link rel="stylesheet" href="../css/certificador.css">
    <script src="../js/respondida.js"></script>
</head>
<body>
<?php 
    include '../includes/headeradmin.php';
?>
    <h1>Preguntas</h1>
    <table class="listas">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Contenido</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Marcar como respondida</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>";
                        echo "<details>";
                        echo "<summary>" . $row['usuario'] . "</summary>";
                        echo "<p>nombre: " . $row['nombre'] . "</p>";
                        echo "<p>apellido: " . $row['apellido'] . "</p>";
                        echo "<p>telefono: " . $row['telefono'] . "</p>";
                        echo "<p>mail: " . $row['mail'] . "</p>";
                        echo "</details>";
                        echo "</td>";
                        echo "<td>" . $row['contenido'] . "</td>";
                        echo "<td>" . $row['fecha'] . "</td>";
                        echo "<td>" . $row['estado'] . "</td>";
                        echo "<td>
                               <input type='checkbox' onclick='marcarRespondida(" . $row['id_pregunta'] . ")'>
                             </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No se encontraron preguntas pendientes.</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <?php include '../includes/footer.php'; ?>
</body>
</html>