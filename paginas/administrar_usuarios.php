<?php
include "../includes/conexion.php";

session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST["buscar"])){
    $busqueda = $_POST['buscar'];
    $buscar = "SELECT * FROM usuarios WHERE nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%' OR mail LIKE '%$busqueda%'";
    $resultado = mysqli_query($conexion, $buscar);
}else{
    $consulta = "SELECT * FROM usuarios";
    $resultado = mysqli_query($conexion, $consulta);
}

if (isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];

    $consulta = "SELECT bloqueado FROM usuarios WHERE id_usuario = '$id_usuario'";
    $resultado = mysqli_query($conexion, $consulta);
    $usuario = mysqli_fetch_assoc($resultado);

    if ($usuario['bloqueado'] == 0) {
        $nuevo_estado = 1;
    } else {
        $nuevo_estado = 0;
    }

    $consulta_actualizacion = "UPDATE usuarios SET bloqueado = $nuevo_estado WHERE id_usuario = '$id_usuario'";
    mysqli_query($conexion, $consulta_actualizacion);

    echo $nuevo_estado ? "Bloqueado" : "Activo";
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Usuarios</title>
    <link rel="stylesheet" href="../css/administrar_usuarios.css">
    <link rel="shortcut icon" href="../imagenes/logoico.ico" type="image/x-icon">
</head>
<body>
<?php include '../includes/headeradmin.php'; ?>
    <h1>Administrar Usuarios</h1>
    <form class="input-group" action="" method="post">
    <input type="text" class="input" name="buscar" placeholder="nombre, apellido, mail del usuario" autocomplete="off">
    <input class="button--submit" value="Buscar" type="submit">
    </form>
    <div class="content">
        <table class="listas">
            <thead>
                <tr>
                    <th class="aparecer">Nombre</th>
                    <th class="esconder">ID</th>
                    <th class="esconder">Nombre</th>
                    <th class="esconder">Apellido</th>
                    <th class="esconder">Correo</th>
                    <th class="esconder">Teléfono</th>
                    <th class="esconder">Rol</th>
                    <th class="">Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td class="aparecer"><?php echo $usuario['id_usuario']; ?></td>
                        <td class="esconder"><?php echo $usuario['id_usuario']; ?></td>
                        <td class="esconder"><?php echo $usuario['nombre']; ?></td>
                        <td class="esconder"><?php echo $usuario['apellido']; ?></td>
                        <td class="esconder"><?php echo $usuario['mail']; ?></td>
                        <td class="esconder"><?php echo $usuario['telefono']; ?></td>
                        <td class="esconder"><?php echo $usuario['rol']; ?></td>
                        <td class="estado"><?php echo $usuario['bloqueado'] ? "Bloqueado" : "Activo"; ?></td>
                        <td>
                            <?php if($usuario['rol']=='Administrador'){ 
                                echo '';
                                }else{ ?>
                            <button class="toggle-status" data-id="<?php echo $usuario['id_usuario']; ?>">
                                <?php echo $usuario['bloqueado'] ? "Desbloquear" : "Bloquear"; ?>
                            </button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="../js/ajax_usuario.js"></script>
    <?php include '../includes/footer.php'; ?>
</body>
</html>