<?php
session_start();
include '../includes/conexion.php';

$id_usuario = @$_SESSION['user_id'];
@$rol_usuario = $_SESSION['rol'];

if(isset($_SESSION['user_id'])){
    $sql = $sql = "SELECT 
    lotes.id_lote, 
    lotes.categoria, 
    lotes.raza, 
    lotes.cantidad, 
    lotes.peso_promedio, 
    MIN(archivo.ruta) AS ruta,
    o.monto AS Monto_Usuario, 
    (SELECT MAX(o.monto) FROM oferta o WHERE o.id_lote = lotes.id_lote) AS Monto_Maximo
FROM 
    lotes
INNER JOIN 
    oferta o ON lotes.id_lote = o.id_lote  
LEFT JOIN 
    archivo ON lotes.id_lote = archivo.id_lote 
WHERE 
    fecha_fin > NOW()
    AND o.id_usuario = $id_usuario
    AND o.monto = (SELECT MAX(o.monto) FROM oferta o WHERE o.id_lote = lotes.id_lote AND o.id_usuario = $id_usuario)
GROUP BY 
    lotes.id_lote";

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
    <script src="../js/actualizar_oferta.js"></script>
</head>
<?php 
    if ($rol_usuario == 'Administrador'){
        include '../includes/headeradmin.php';
    } else {
        include '../includes/header.php';
    }
?>
<body>

    <div class="content">
        <h2>Ofertas del Usuario</h2>
        <?php
        if(!isset($_SESSION['user_id'])){
            echo "<div class='no-lotes'>Debe iniciar sesión para ver sus ofertas.</div>";
        } else {
            if(mysqli_num_rows($result) > 0) {
                echo "<table class='listas'>
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th class='esconder'>Categoría</th>
                                <th class='esconder'>Cantidad</th>
                                <th class='esconder'>Peso Promedio</th>
                                <th>Tu Oferta</th>
                                <th>Oferta Más Alta</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $color_usuario = $row['Monto_Usuario'] < $row['Monto_Maximo'] ? 'red' : 'green';
                    $color_maximo = $row['Monto_Usuario'] == $row['Monto_Maximo'] ? 'green' : 'black';
                    echo "<tr>";
                    echo "<td><a href='especificaciones.php?id=" . $row['id_lote'] . "'><img src='" . $row['ruta'] . "' alt='" . $row['categoria'] . "'></a></td>";  
                    echo "<td class='esconder'>" . $row['categoria'] . "</td>";
                    echo "<td class='esconder'>" . $row['cantidad'] . "</td>";
                    echo "<td class='esconder'>" . $row['peso_promedio'] . "</td>";
                    echo "<div id='oferta_usuario'><td>" . ($row['Monto_Usuario'] ?: 'N/A') . "</td></div>";
                    echo "<div id='oferta_actual'><td>" . ($row['Monto_Maximo'] ?: 'N/A') . "</td></div>";
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