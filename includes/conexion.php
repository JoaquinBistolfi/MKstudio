<?php

$conexion = mysqli_connect("localhost", "root", "", "proyectonuevo");

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

?>