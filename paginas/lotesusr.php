<?php
session_start();

include '../includes/conexion.php';

@$rol_usuario = $_SESSION['rol'];

$sql = "SELECT 
            lotes.id_lote, 
            lotes.categoria, 
            lotes.raza, 
            lotes.cantidad, 
            lotes.peso_promedio, 
            MIN(archivo.ruta) AS ruta 
        FROM 
            lotes 
        LEFT JOIN 
            archivo ON lotes.id_lote = archivo.id_lote 
        WHERE 
            fecha_fin > NOW() 
            AND lotes.vendido = 0
        GROUP BY 
            lotes.id_lote";

$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotes</title>
    <link rel="stylesheet" href="../css/lotesusr.css">
    <link rel="shortcut icon" href="../imagenes/logoico.ico" type="image/x-icon">
    <script src="../js/linkfila.js"></script>
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
            echo "<table class='listas'>
                    <thead>
                        <tr>
                            <th class='esconder600'>Foto</th>
                            <th class='esconder'>Categoría</th>
                            <th class='esconder'>Raza</th>
                            <th class='esconder'>Cantidad</th>
                            <th class='esconder'>Peso Promedio</th>
                            <th class='aparecer'>Lote</th>
                        </tr>
                    </thead>
                    <tbody>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='fila-enlace' data-href='especificaciones.php?id=" . $row['id_lote'] . "'>";
                        echo "<td class='esconder600'><img src='" . $row['ruta'] . "' alt='" . $row['categoria'] . "'></td>";  
                        echo "<td class='esconder'>" . $row['categoria'] . "</td>";
                        echo "<td class='esconder'>" . $row['raza'] . "</td>";
                        echo "<td class='esconder'>" . $row['cantidad'] . "</td>";
                        echo "<td class='esconder'>" . $row['peso_promedio'] . "</td>";
                        echo "<td class='aparecer'>" . $row['cantidad'] . ' ' . $row['categoria'] . "</td>";
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