<?php 
session_start();

include '../includes/conexion.php';
@$rol_usuario = $_SESSION['rol'];
$lote_id = $_GET['id'];

$sql = "SELECT * FROM lotes WHERE id_lote = '$lote_id'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result) > 0) {
    $lote = mysqli_fetch_assoc($result);
} else {
    echo "<p>No se encontró el lote.</p>";
}

$sql2 = "SELECT id_oferta, u.usuario, u.apellido FROM oferta o, usuarios u WHERE o.id_usuario = u.id_usuario
         AND monto = ( SELECT MAX(monto) FROM oferta WHERE id_lote = '$lote_id' );;";
        $result2 = mysqli_query($conexion, $sql2);
        
        if (mysqli_num_rows($result2) > 0) {
            $oferta = mysqli_fetch_assoc($result2);
            $id_oferta = $oferta['id_oferta'];
            $nombre = $oferta['usuario'];
            $apellido = $oferta['apellido'];
        } else {
            echo "<p>No se encontró la oferta.</p>";
}

$sql = "
    SELECT 
        o.monto, 
        l.cantidad, 
        l.peso_promedio, 
        COALESCE(SUM(p.monto_pago), 0) AS total_pagado 
    FROM 
        oferta o 
    JOIN 
        lotes l ON o.id_lote = l.id_lote 
    LEFT JOIN 
        pago p ON p.id_oferta = o.id_oferta 
    WHERE 
        o.monto = (
            SELECT MAX(monto) 
            FROM oferta 
            WHERE id_lote = o.id_lote
            AND id_lote = '$lote_id'
        )      
    GROUP BY 
        o.id_oferta;
";
$result = mysqli_query($conexion, $sql);
$cuentas = mysqli_fetch_assoc($result);

$total = $cuentas['monto'] * $cuentas['cantidad'] * $cuentas['peso_promedio'];
$falta = $total - $cuentas['total_pagado']; 
        

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fecha']) && isset($_POST['metodo'])) {
    if (!empty($_POST["monto"]) && !empty($_POST["fecha"]) && !empty($_POST["metodo"])) {
        $monto = $_POST['monto'];
        $fecha = $_POST['fecha'];
        $metodo = $_POST['metodo'];
        
            $sql_pago = "INSERT INTO pago (monto_pago, fecha, metodo_pago, id_oferta) VALUES ('$monto', '$fecha', '$metodo', '$id_oferta')";
            mysqli_query($conexion, $sql_pago);
        } else {
            echo "<p>No se encontró la oferta.</p>";
        }
    }

$sql_lotes = "SELECT * FROM pago WHERE id_oferta IN (
    SELECT id_oferta FROM oferta WHERE id_lote = '$lote_id'
)";
$result_lotes = mysqli_query($conexion, $sql_lotes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/certificador.css">
    <title>Document</title>
</head>
<body>
<?php 
    if ($rol_usuario == 'Administrador'){
            include '../includes/headeradmin.php';
    } else {
            include '../includes/header.php';
    }
?>

<h1>Agregar pago a <?php echo $lote['cantidad'] . " " . $lote['categoria']. ' comprados por: ' . $nombre . ' ' . $apellido; ?></h1>

<form action="" method="post">
    <label for="Monto">Monto:
        <input type="number" name="monto" min="1"max="<?php echo $falta; ?>" required >
    </label>
    <br>
    <label for="fecha">Fecha del pago:
        <input type="datetime-local" name="fecha" required>
    </label>
    <label for="metodo">Metodo:
        <input type="text" name="metodo" required>
    </label>
    <input type="submit" value="Subir">
</form>

<h1>Pagos anteriores</h1>
<table class="listas">
    <thead>
        <tr>
            <th>Monto</th>
            <th>Fecha</th>
            <th>Metodo</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (mysqli_num_rows($result_lotes) > 0) {
                while ($row = mysqli_fetch_assoc($result_lotes)) {
                    echo "<tr>";
                    echo "<td>" . $row['monto_pago'] . "</td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $row['metodo_pago'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron pagos.</td></tr>";
            }
        ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>
</body>
</html>
