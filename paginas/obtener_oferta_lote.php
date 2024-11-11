<?php
include '../includes/conexion.php';
session_start();

if (isset($_GET['id'])) {
    $lote_id = $_GET['id'];

    $sql = "SELECT * FROM oferta WHERE id_lote = '$lote_id' ORDER BY monto DESC LIMIT 1";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        $oferta = mysqli_fetch_assoc($result);
        $es_usuario = ($oferta['id_usuario'] == $_SESSION['user_id']);
        echo json_encode([
            'monto' => $oferta['monto'],
            'es_usuario' => $es_usuario
        ]);
    } else {
        echo json_encode([
            'monto' => "No hay ofertas",
            'es_usuario' => false
        ]);
    }
}
?>
