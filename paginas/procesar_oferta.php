<?php
include '../includes/conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oferta = $_POST['oferta'];
    $usr_id = $_SESSION['user_id'];
    $lote_id = $_SESSION['lote_id'];
    $fecha = date("Y-m-d H:i:s");
}

$sql = "INSERT INTO `oferta` (`ID_Oferta`, `Monto`, `Fecha`, `ID_Lote`, `ID_Usuario`) VALUES (NULL, '$oferta', '$fecha', '$lote_id', '$usr_id');";
$result = mysqli_query($conexion, $sql);


$lote_id = $_SESSION['lote_id'];
header("Location: especificaciones.php?id=" . $lote_id);
?>