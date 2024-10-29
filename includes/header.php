<?php
include '../includes/conexion.php';

@$id_usuario = @$_SESSION['user_id'];

$sql = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario';";
$result = mysqli_query($conexion, $sql);
if (!$result) {
    die("Error en la consulta SQL: " . mysqli_error($conexion));
}
$usuario = mysqli_fetch_assoc($result);
?>

<header>
    <link rel="stylesheet" href="../css/header.css">
    
    <input type="checkbox" id="activar" class="header_checkbox"> 
    <label for="activar" class="abrir_menu" role="button">=</label>
    <a href="index.php"><img class="header_logo" src="../imagenes/darosa.png" alt="logo de la empresa"></a>
    
    <nav class="header_nav">
        <ul class="header_nav_lista">
            <li class="header_nav_link"><a href="../paginas/estadisticas.php">Estadísticas</a></li>
            <li class="header_nav_link"><a href="../paginas/mis_ofertas.php">Mis ofertas</a></li>
            <li class="header_nav_link"><a href="../paginas/lotesusr.php">Lotes</a></li>
        </ul>
    </nav>

    <div class="perfil-usr">
        <input type="checkbox" id="user-menu-btn" class="user-checkbox">
        <label for="user-menu-btn">
            <img src="../imagenes/avatar.png" alt="Usuario" class="user-icon">
        </label>
        <div class="user-menu">
            <p><strong>Nombre:</strong> <?php echo @$usuario['nombre']; ?></p>
            <p><strong>Email:</strong> <?php echo @$usuario['mail']; ?></p>
            <a href="../paginas/sessiondestroy.php">Cerrar sesión</a>
        </div>
    </div>
</header>

