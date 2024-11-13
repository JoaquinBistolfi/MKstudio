<?php
session_start();

include '../includes/conexion.php';

@$rol_usuario = $_SESSION['rol'];
$id_usuario = @$_SESSION['user_id'];

$sql = "
    SELECT 
    p.*, 
    o.*, 
    u.id_usuario,
    l.*,
    MIN(a.ruta) AS ruta, 
    COALESCE(SUM(p.monto_pago), 0) AS total_pagado 
FROM 
    oferta o 
JOIN 
    lotes l ON o.id_lote = l.id_lote 
JOIN 
    usuarios u ON o.id_usuario = u.id_usuario 
JOIN 
    archivo a ON a.id_lote = l.id_lote 
LEFT JOIN 
    pago p ON p.id_oferta = o.id_oferta 
WHERE 
    o.monto = (
        SELECT MAX(monto) 
        FROM oferta 
        WHERE id_lote = o.id_lote
        AND id_usuario = $id_usuario
    )
    AND l.vendido = 1
GROUP BY 
    l.id_lote, u.id_usuario; 
";
$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis pagos</title>
    <link rel="stylesheet" href="../css/lotesusr.css">
    <link rel="shortcut icon" href="../imagenes/logoico.ico" type="image/x-icon">

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
        <h2>Lista de pagos pendientes</h2>
        <?php
        if(!isset($_SESSION['user_id'])){
            echo "<div class='no-lotes'>Debe iniciar sesión para ver los pagos pendiente.</div>";
        } else {
            if (mysqli_num_rows($result) > 0) {
            echo "<table class='listas'>
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th class='esconder'>Lote</th>
                            <th class='esconder'>Total</th>
                            <th class='esconder'>Pagado</th>
                            <th>Falta</th>
                            <th>Nota de venta</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                $total = $row['monto'] * $row['cantidad'] * $row['peso_promedio'];
                $falta = $total - $row['total_pagado']; 

                if ($falta > 0) {
                    echo "<tr>";
                    echo "<td><img src='" . $row['ruta'] . "' alt='" . $row['categoria'] . "'></td>";  
                    echo "<td class='esconder'>" . $row['categoria'] . ' ' . $row['raza'] . ' ' . $row['cantidad'] . "</td>";
                    echo "<td class='esconder'>" . $total . "</td>";
                    echo "<td class='esconder'>" . $row['total_pagado'] . "</td>";  
                    echo "<td>" . $falta . "</td>";
                    echo "<td><a href='pdf/pdf.php?id=" . $row['id_lote'] . "'><img src='../imagenes/ojo-abierto.png' alt='nota_de_venta' class='factura'></a></td>";
                    echo "</tr>";
                } else {
                    echo "<tr><td colspan='6'>Usted no tiene deudas.</td></tr>";
                }
            }
            echo '</tbody></table>';
        } else {
            echo "<div class='no-lotes'>Usted no ha realizado ninguna compra.</div>";
        }
    }
        ?>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
