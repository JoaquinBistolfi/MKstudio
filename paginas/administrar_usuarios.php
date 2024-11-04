<?php
include "../includes/conexion.php";

session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST["buscar"])){
    @$busqueda = @$_POST['buscar'];
    $buscar = "SELECT * FROM usuarios WHERE nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%'";
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
</head>
<body>
    <?php include '../includes/headeradmin.php'; ?>
    <h1>Administrar Usuarios</h1>
    <form action="" method="post">
    Buscar usuario: <input type="text" name="buscar">
    <input type="button" value="Busca">
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($usuario = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><?php echo $usuario['id_usuario']; ?></td>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td><?php echo $usuario['apellido']; ?></td>
                    <td><?php echo $usuario['mail']; ?></td>
                    <td><?php echo $usuario['telefono']; ?></td>
                    <td><?php echo $usuario['rol']; ?></td>
                    <td class="estado"><?php echo $usuario['bloqueado'] ? "Bloqueado" : "Activo"; ?></td>
                    <td>
                        <button class="toggle-status" data-id="<?php echo $usuario['id_usuario']; ?>">
                            <?php echo $usuario['bloqueado'] ? "Desbloquear" : "Bloquear"; ?>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script src="../js/ajax_usuario.js"></script>
    <?php include '../includes/footer.php'; ?>
</body>
</html>