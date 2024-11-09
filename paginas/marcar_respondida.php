<?php
include '../includes/conexion.php';

if (isset($_GET['id'])) {
    $idPregunta = intval($_GET['id']); 
    $sql = "DELETE FROM pregunta WHERE id_pregunta = $idPregunta";
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