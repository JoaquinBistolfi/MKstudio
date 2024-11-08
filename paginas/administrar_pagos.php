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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fecha']) && isset($_POST['metodo'])) {
    if (!empty($_POST["monto"]) && !empty($_POST["fecha"]) && !empty($_POST["metodo"])) {
        $monto = $_POST['monto'];
        $fecha = $_POST['fecha'];
        $metodo = $_POST['metodo'];
        
        $sql2 = "SELECT id_oferta, id_usuario FROM oferta o, usuarios u WHERE o.id_usuario = u.id_usuario AND monto = (
            SELECT MAX(monto) 
            FROM oferta 
            WHERE id_lote = $lote_id
            );";
        $result2 = mysqli_query($conexion, $sql2);
        
        if (mysqli_num_rows($result2) > 0) {
            $oferta = mysqli_fetch_assoc($result2);
            $id_oferta = $oferta['id_oferta'];
            $usuario = $oferta['id_usuario'];
            
            $sql_pago = "INSERT INTO pago (monto_pago, fecha, metodo_pago, id_oferta) VALUES ('$monto', '$fecha', '$metodo', '$id_oferta')";
            mysqli_query($conexion, $sql_pago);
        } else {
            echo "<p>No se encontró la oferta.</p>";
        }
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

<h1>Agregar pago a <?php echo $lote['cantidad'] . " " . $lote['categoria'] . $usuario; ?></h1>

<form action="" method="post">
    <label for="Monto">Monto:
        <input type="text" name="monto" required>
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
