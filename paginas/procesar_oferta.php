<?php
include '../includes/conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oferta = $_POST['oferta'];
    $usr_id = $_SESSION['user_id'];
    $lote_id = $_SESSION['lote_id'];
    $fecha = date("Y-m-d H:i:s");

    $sql = "INSERT INTO `oferta` (`id_oferta`, `monto`, `fecha_oferta`, `id_lote`, `id_usuario`) VALUES (NULL, '$oferta', '$fecha', '$lote_id', '$usr_id');";
    $result = mysqli_query($conexion, $sql);

    if ($result) {
        $_SESSION['oferta'] = "echo"; 
    } else {
        $_SESSION['oferta'] = "no"; 
    }
    header("Location: especificaciones.php?id=" . $lote_id);
}

?>