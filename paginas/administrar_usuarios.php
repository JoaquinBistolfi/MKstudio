<?php
include "../includes/conexion.php";

session_start();

@$rol_usuario = $_SESSION['rol'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST["buscar"])) {
    $busqueda = $_POST['buscar'];
    $buscar = "SELECT * FROM usuarios WHERE nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%' OR mail LIKE '%$busqueda%'";
    $resultado = mysqli_query($conexion, $buscar);
} else {
    $consulta = "SELECT * FROM usuarios";
    $resultado = mysqli_query($conexion, $consulta);
}

if (isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];

    $consulta = "SELECT bloqueado FROM usuarios WHERE id_usuario = '$id_usuario'";
    $resultado = mysqli_query($conexion, $consulta);
    $usuario = mysqli_fetch_assoc($resultado);

    $nuevo_estado = $usuario['bloqueado'] == 0 ? 1 : 0;

    $consulta_actualizacion = "UPDATE usuarios SET bloqueado = $nuevo_estado WHERE id_usuario = '$id_usuario'";
    mysqli_query($conexion, $consulta_actualizacion);

    echo $nuevo_estado ? "Bloqueado" : "Activo";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion Usuarios</title>
    <link rel="stylesheet" href="../css/lotesusr.css">
</head>
<body>
<?php 
    if ($rol_usuario == 'Administrador') {
        include '../includes/headeradmin.php';
    } else {
        include '../includes/header.php';
    }
?>
<body>

    <div class="content">
        <h2>Lista de Lotes Disponibles</h2> 
        <form class="input-group" action="" method="post">
        <input type="text" class="input" name="buscar" placeholder="nombre, apellido, mail del usuario" autocomplete="off">
        <input class="button--submit" value="Buscar" type="submit">
        </form>
        <?php
        if (mysqli_num_rows($resultado) > 0) {
            echo "<table class='listas'>
                    <thead>
                        <tr>
                            <th class='esconder'>ID</th>
                            <th>Nombre</th>
                            <th class='esconder'>Mail</th>
                            <th class='esconder'>Teléfono</th>
                            <th class='esconder'>Rol</th>
                        </tr>
                    </thead>
                    <tbody>";
                    while ($usuario = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td class='esconder'>" . $usuario['id_usuario'] . "</td>";
                        echo "<td>" . $usuario['nombre'] . " " . $usuario['apellido'] . "</td>";
                        echo "<td class='esconder'>" . $usuario['mail'] . "</td>";
                        echo "<td class='esconder'>" . $usuario['telefono'] . "</td>";
                        echo "<td class='esconder'>" . $usuario['rol'] . "</td>";
                        echo "<td>";
                        if ($usuario['rol'] == 'Administrador') { 
                            echo '';
                        } else {
                            echo "<button class='toggle-status' data-id='" . $usuario['id_usuario'] . "'>";
                            echo $usuario['bloqueado'] ? 'Desbloquear' : 'Bloquear';
                            echo "</button>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
            echo '</tbody></table>';
        } else {
            echo "<div class='no-lotes'>No se encontraron usuarios.</div>";
        }
        ?>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="../js/ajax_usuario.js"></script>
</body>
</html>
