<?php

$conexion = mysqli_connect("localhost", "root", "", "proyecto");

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

?>