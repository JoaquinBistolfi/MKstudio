<?php
session_start();

include '../includes/conexion.php';

$id_usuario = @$_SESSION['ID_Usuario'];
@$rol_usuario = $_SESSION['rol'];


if(isset($_SESSION['ID_Usuario'])){
    $sql = "SELECT l.id_lote, l.categoria, l.raza, l.cantidad, l.peso_promedio, a.ruta AS Ruta_archivo, 
                   o.Monto AS Monto_Usuario, 
                   (SELECT MAX(Monto) FROM oferta WHERE ID_Lote = l.ID_Lote) AS Monto_Maximo
            FROM lotes l
            LEFT JOIN archivo a ON l.id_lote = a.id_lote
            LEFT JOIN oferta o ON l.ID_Lote = o.ID_Lote
            WHERE o.ID_Usuario = '$id_usuario'";  
$result = mysqli_query($conexion, $sql);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas Lotes</title>
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
        <h2>Ofertas del Usuario</h2>
        <?php
       if(!isset($_SESSION['ID_Usuario'])){
        echo "<div class='no-lotes'>Debe iniciar sesion para ver sus ofertas.</div>";
       }else{
       if(mysqli_num_rows($result) > 0) {
            echo '<table class="listas">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Peso</th>
                            <th>Tu Oferta</th>
                            <th>Oferta Más Alta</th>
                        </tr>
                    </thead>
                    <tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                $color_usuario = $row['Monto_Usuario'] < $row['Monto_Maximo'] ? 'red' : 'gold';
                $color_maximo = $row['Monto_Usuario'] == $row['Monto_Maximo'] ? 'gold' : 'black';
                echo "<tr>";
                echo "<td><a href='especificaciones.php?id=" . $row['ID_Lote'] . "'><img src='" . $row['Ruta_archivo'] . "' alt='" . $row['Categoria'] . "'></a></td>";  
                echo "<td>" . $row['Categoria'] . "</td>";
                echo "<td>" . $row['Cantidad'] . "</td>";
                echo "<td>" . $row['Peso_Prom'] . "</td>";
                echo "<td style='color: $color_usuario;'>" . $row['Monto_Usuario'] . "</td>";
                echo "<td style='color: $color_maximo;'>" . $row['Monto_Maximo'] . "</td>";
                echo "</tr>";
            }
            echo '</tbody></table>';
        } else {
            echo "<div class='no-lotes'>Todavía no has hecho ninguna oferta.</div>";
    }
}
        ?>
    </div>
</body>
<?php include '../includes/footer.php'; ?>
</html>