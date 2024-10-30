<?php
session_start();

include '../includes/conexion.php';

@$rol_usuario = $_SESSION['rol'];

$sql_lotes = "INSERT INTO pagos (categoria, cantidad, peso_promedio, peso_maximo, peso_minimo, cant_pesada, estado, raza, edad, clase, sanidad, tratamiento_nutricional, observaciones, conoce_miomio, zona_garrapata, fecha_inicio, fecha_fin, id_certificador) 
                              VALUES ('$categoria', '$cantidad', '$peso', '$peso_maximo', '$peso_minimo', '$cant_pesada', '$estado', '$raza', '$edad', '$clase', '$sanidad', '$tratamiento_nutricional', '$observaciones', '$conoce_miomio', '$zona_garrapata', '$fecha_ini', '$fecha_fin', '$certificador')";


$sql = "SELECT * FROM pagos p, lote l, oferta o, usuario u WHERE ";

SELECT * FROM oferta o, usuarios u, lotes l, WHERE o.id_lote=l.id_lote AND o.id_usuario=u.id_usuario

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
                            <th>Lote</th>
                            <th>Total</th>
                            <th>Pagado</th>
                            <th>Falta</th>
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
