<?php
session_start();

include '../includes/conexion.php';

@$rol_usuario = $_SESSION['rol'];

$sql = "SELECT lotes.id_lote, lotes.categoria, lotes.raza, lotes.cantidad, lotes.peso_promedio, archivo.ruta 
        FROM lotes 
        LEFT JOIN archivo ON lotes.id_lote = archivo.id_lote WHERE fecha_fin>NOW()";

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
<?php 
    if ($rol_usuario == 'Administrador'){
            include '../includes/headeradmin.php';
    }else{
            include '../includes/header.php';
    }
 ?>
<body>

    <div class="content">
        <h2>Lista de Lotes Disponibles</h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo '<table class="listas">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Categoría</th>
                            <th>Raza</th>
                            <th>Cantidad</th>
                            <th>Peso Promedio</th>
                        </tr>
                    </thead>
                    <tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><a href='especificaciones.php?id=" . $row['id_lote'] . "'><img src='" . $row['ruta'] . "' alt='" . $row['categoria'] . "'></a></td>";  
                echo "<td>" . $row['categoria'] . "</td>";
                echo "<td>" . $row['raza'] . "</td>";
                echo "<td>" . $row['cantidad'] . "</td>";
                echo "<td>" . $row['peso_promedio'] . "</td>";
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