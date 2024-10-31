<?php
session_start();

include '../includes/conexion.php';

@$rol_usuario = $_SESSION['rol'];

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
        )
    GROUP BY 
        o.id_oferta;  -- Agrupar por el ID de la oferta
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
                        </tr>
                    </thead>
                    <tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                $total = $row['monto'] * $row['cantidad'] * $row['peso_promedio'];
                $falta = $total - $row['total_pagado'];  // Cambiar a total_pagado
                echo "<tr>";
                echo "<td><a href='administrar_pagos.php?id=" . $row['id_lote'] . "'><img src='" . $row['ruta'] . "' alt='" . $row['categoria'] . "'></a></td>";  
                echo "<td>" . $row['categoria'] . ' ' . $row['raza'] . ' ' . $row['cantidad'] . "</td>";
                echo "<td>" . $total . "</td>";
                echo "<td>" . $row['total_pagado'] . "</td>";  // Usar total_pagado
                echo "<td>" . $falta . "</td>";
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
