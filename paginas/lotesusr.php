<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "proyecto");

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

//$id_usuario = $_SESSION['id_usuario'];

//$sql_rol = "SELECT rol FROM usuarios WHERE ID_Usuario = '$id_usuario'";
//$result_rol = mysqli_query($conexion, $sql_rol);
//$row_rol = mysqli_fetch_assoc($result_rol);
//$rol_usuario = $row_rol['rol'];

$rol_usuario = 'Administrador';//para no tener que iniciar sesion.

$sql = "SELECT ID_Lote, Categoria, Cantidad_Raza, Cantidad, Peso_Prom, Ruta_archivo FROM lotes";
$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotes</title>
    <link rel="stylesheet" href="../css/lotesusr.css">
</head>
<?php include '../includes/header.php'; ?>
<body>

    <div class="content">
        <h2>Lista de lotes subidos</h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo '<table class="listas">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Categoría</th>
                            <th>Raza</th>
                            <th>Cantidad</th>
                            <th>Peso</th>
                        </tr>
                    </thead>
                    <tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><a href='especificaciones.php?id=" . $row['ID_Lote'] . "'><img src='" . $row['Ruta_archivo'] . "' alt='" . $row['Categoria'] . "'></a></td>";  
                echo "<td>" . $row['Categoria'] . "</td>";
                echo "<td>" . $row['Cantidad_Raza'] . "</td>";
                echo "<td>" . $row['Cantidad'] . "</td>";
                echo "<td>" . $row['Peso_Prom'] . "</td>";
                echo "</tr>";
            }
            echo '</tbody></table>';
        } else {
            echo "<div class='no-lotes'>No se encontraron lotes.</div>";
        }
        ?>
    </div>

    <?php if ($rol_usuario == 'Administrador'): ?>
        <button class="fixed-button" onclick="window.location.href='lotes.php'">Agregar Lotes</button>
        <script>
            document.querySelector('.fixed-button').style.display = 'block';
        </script>
    <?php endif; ?>

    <?php include '../includes/footer.php'; ?>
</body>
</html>