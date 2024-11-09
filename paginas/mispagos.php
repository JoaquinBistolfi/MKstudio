<?php
session_start();

include '../includes/conexion.php';

@$rol_usuario = $_SESSION['rol'];
$id_usuario = @$_SESSION['user_id'];

$sql = "
    SELECT 
        p.*, 
        o.*, 
        u.*, 
        l.*, 
        a.ruta, 
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
    GROUP BY 
        o.id_oferta;
;";
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
    } else {
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
                            <th>Nota de venta</th>
                        </tr>
                    </thead>
                    <tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                $total = $row['monto'] * $row['cantidad'] * $row['peso_promedio'];
                $falta = $total - $row['total_pagado']; 

                if ($falta > 0) {
                    echo "<tr>";
                    echo "<td><a href='administrar_pagos.php?id=" . $row['id_lote'] . "'><img src='" . $row['ruta'] . "' alt='" . $row['categoria'] . "'></a></td>";  
                    echo "<td>" . $row['categoria'] . ' ' . $row['raza'] . ' ' . $row['cantidad'] . "</td>";
                    echo "<td>" . $total . "</td>";
                    echo "<td>" . $row['total_pagado'] . "</td>";  
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
        ?>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>