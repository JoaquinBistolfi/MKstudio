<?php
include '../includes/conexion.php';

if (isset($_GET['id'])) {
    $lote_id = $_GET['id'];

    $sql = "SELECT * FROM oferta WHERE id_lote = '$lote_id' ORDER BY monto DESC LIMIT 1";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        $oferta = mysqli_fetch_assoc($result);
        echo json_encode($oferta);
    } else {
        echo json_encode(["monto" => "No hay ofertas"]);
    }
} else {
    echo json_encode(["error" => "Lote no encontrado"]);
}
