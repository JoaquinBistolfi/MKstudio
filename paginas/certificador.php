<?php
include '../includes/conexion.php'; 

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["profesion"]) && !empty($_FILES["archivo"])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $profesion = $_POST['profesion'];
        $foto_lote = $_FILES['archivo']['name'];
        $tmp_name = $_FILES['archivo']['tmp_name'];

        $ruta_destino = "perfil_certificador/" . basename($foto_lote); 

        if (move_uploaded_file($tmp_name, $ruta_destino)) {
            $sql_lotes = "INSERT INTO `certificador` (`nombre`, `apellido`, `profesion`, `ruta_archivo`) 
                          VALUES ('$nombre', '$apellido', '$profesion', '$ruta_destino')";
            
            if (mysqli_query($conexion, $sql_lotes)) {
                header("Location: certificador.php");
            } else {
                echo "Error: " . mysqli_error($conexion);
            }
        } else {
            echo "Error al mover el archivo subido.";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

$sql = "SELECT * FROM certificador;";

$result = mysqli_query($conexion, $sql);
if (!$result) {
    die("Error en la consulta SQL: " . mysqli_error($conexion));
}

@$rol_usuario = $_SESSION['rol'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar nuevo certificador</title>
    <link rel="stylesheet" href="../css/certificador.css">
</head>
    <?php 
    if ($rol_usuario == 'Administrador'){
            include '../includes/headeradmin.php';
    }else{
            include '../includes/header.php';
    }
    ?>
    <body>
    <h1>Agregar nuevo certificador</h1> 
    <form action="" method="post" enctype="multipart/form-data">
        <label for="Nombre">Nombre:
            <input type="text" name="nombre" required>
        </label>
        <br>
        <label for="Apellido">Apellido:
            <input type="text" name="apellido" required>
        </label>
        <br>
        <label for="Profesion">Profesión:
            <input type="text" name="profesion" required>
        </label>
        <br>
        <label for="foto_lote">Foto principal del lote:
            <input type="file" name="archivo" id="foto_lote" required accept=".jpg, .png">
        </label>
        <br>
        <input type="submit" value="Subir">
    </form>
    <h1>Certificadores registrados</h1>
    <table class="listas">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Profesion</th>
            </tr>
        </thead>
        <tbody>
            <div class="fila_tabla">
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><img src='" . $row['ruta_archivo'] . "' alt='" . $row['nombre'] . "'></td>";  
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['apellido'] . "</td>";
                        echo "<td>" . $row['profesion'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "No se encontraron lotes.";
                }
            ?>
            </div>
        </tbody>
    </table>
</body>
<?php include '../includes/footer.php'; ?>
</html>
