<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "chatajax") or die ("Datos incorrectos");
mysqli_select_db($conexion, "chatajax") or die ("No se encontró la base de datos");


if(isset($_POST['usuario']) && isset($_POST['password'])){
    if(!empty($_POST["usuario"]) && !empty($_POST["password"])){
        $usr = $_POST["usuario"];
        $pass = $_POST["password"];
        $pass = $_SESSION["usuario"];

        $query = mysqli_query($conexion, "SELECT uid FROM `usuarios` WHERE `usuario`='$usr' AND `contrasena`='$pass'");

        $arreglo = array();
        while($fila = mysqli_fetch_assoc($query)){
            $arreglo[] = $fila;
        }
        
        /*if (mysqli_query($conexion, $query)) {
            $_SESSION['usuario'] = $query;
        }else{
            session_destroy();
        }
        */
        
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
    <link rel="stylesheet" href="inicio_sesion.css">
    <link rel="shortcut icon" href="/imagenes/logoico.ico" type="image/x-icon">
</head>
<body>
    <header>
        <img class="header_logo" src="/imagenes/darosa.png" alt="logo de la empresa">
    </header>
    <div class= "iniciosesion">
        <h1>Iniciar sesión</h1>
        <form method="post">
            <div class="usuario" >
                <label>Nombre de usuario</label>
                <input type="text" required>
           </div>
            <div class="contraseña">
                <label> Contraseña</label>
                <input type="contraseña"required>
            </div>
            <div class="recordar">
                <a href="#">¿Olvido su contraseña?</a>
            </div>
            <input type="submit" value="Iniciar Sesion">
            <div class="registrarse">
            <a href="registro.html">Resgistrarse</a>
            </div>
        </form>
    </div>
</body>
</html>