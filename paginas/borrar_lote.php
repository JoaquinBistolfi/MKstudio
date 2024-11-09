<?php
include '../includes/conexion.php';

if (isset($_GET['id'])) {
    $idlote = intval($_GET['id']);
    
    $sql_archivo = "SELECT ruta FROM archivo WHERE id_lote = $idlote";
    $result_archivo = mysqli_query($conexion, $sql_archivo);
    $archivo = mysqli_fetch_assoc($result_archivo);

    if ($archivo && file_exists($archivo['ruta'])) {
        unlink($archivo['ruta']);
    }

    $sql_delete_archivo = "DELETE FROM archivo WHERE id_lote = $idlote";
    mysqli_query($conexion, $sql_delete_archivo);

    $sql = "DELETE FROM lotes WHERE id_lote = $idlote";
    $result = mysqli_query($conexion, $sql);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
