<?php
include '../includes/conexion.php';

@$id_usuario = @$_SESSION['user_id'];

$sql_usuarios = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario';";
$result_usuarios = mysqli_query($conexion, $sql_usuarios);
if (!$result_usuarios) {
    die("Error en la consulta SQL: " . mysqli_error($conexion));
}
$usuario = mysqli_fetch_assoc($result_usuarios);
?>

<header>
    <link rel="stylesheet" href="../css/header.css">
    
    <input type="checkbox" id="activar" class="header_checkbox"> 
    <label for="activar" class="abrir_menu" role="button">=</label>
    <a href="../index.php"><img class="header_logo" src="../imagenes/darosa.png" alt="logo de la empresa"></a>
    
    <nav class="header_nav">
        <ul class="header_nav_lista">
            <li class="header_nav_link"><a href="../paginas/estadisticas.php">Estadísticas</a></li>
            <li class="header_nav_link"><a href="../paginas/mis_ofertas.php">Mis ofertas</a></li>
            <li class="header_nav_link"><a href="../paginas/lotesusr.php">Lotes</a></li>
            <li class="header_nav_link"><a href="../paginas/mispagos.php">Mis pagos</a></li>
        </ul>
    </nav>
    <?php if (isset($_SESSION['user_id'])) {
        echo'
    <div class="perfil-usr">
        <input type="checkbox" id="user-menu-btn" class="user-checkbox">
        <label for="user-menu-btn">
            <img src="../imagenes/avatar.png" alt="Usuario" class="user-icon">
        </label>
        <div class="user-menu">
            <p><strong>Usuario:</strong>' . @$usuario['usuario'] . ' </p>
            <p><strong>Email:</strong>' . @$usuario['mail'] . '</p>
            <a href="../paginas/sessiondestroy.php">Cerrar sesión</a>
        </div>
    </div>';
    }else{
        echo'
        <a href="inicio_sesion.php"><img src="../imagenes/avatar.png" alt="Usuario" class="user-icon"></a>
        ';
    }?>
</header>

