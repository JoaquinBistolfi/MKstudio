<?php
$conexion = mysqli_connect("localhost", "root", "", "proyecto") or die("Datos incorrectos");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['titulo']) && isset($_FILES['archivo'])) {
    if (!empty($_POST["titulo"]) && !empty($_FILES["archivo"])) {
        $titulo = $_POST['titulo'];
        $foto_lote = $_FILES['archivo']['name'];
        $tmp_name = $_FILES['archivo']['tmp_name'];

        if ($foto_lote != '') {
            $nombre_archivo_unico = $titulo . '_' . $foto_lote;
            $ruta_archivo = 'foto_lote/' . $titulo . '/' . $nombre_archivo_unico;

            if (!file_exists('foto_lote/' . $titulo)) {
                if (!mkdir('foto_lote/' . $titulo, 0777, true)) {
                    die("Error al crear el directorio.");
                }
            }

            if (move_uploaded_file($tmp_name, $ruta_archivo)) {
                $sql = "INSERT INTO lotes (titulo, ruta_archivo) VALUES ('$titulo', '$ruta_archivo')";
                if (mysqli_query($conexion, $sql)) {
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit;
                } else {
                    echo "Error al guardar los datos: " . mysqli_error($conexion);
                }
            } else {
                echo "Error al mover el archivo subido.";
            }
        }
    }
}

// Recuperar y mostrar los datos
$sql = "SELECT titulo, ruta_archivo FROM lotes";
$result = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>  
    <link rel="stylesheet" href="../css/lotes.css">
    
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="titulo_lote">
            Título del lote:
            <input type="text" name="titulo" id="titulo_lote" required>
        </label>
        <label for="foto_lote">
            Foto principal del lote:
            <input type="file" name="archivo" id="foto_lote" required accept=".jpg, .png">
        </label>
        <input type="submit" value="Subir">
    </form>

    <h2>Lista de lotes subidos</h2>
    <ul class="listas">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>";
                echo "<h3>" . htmlspecialchars($row['titulo']) . "</h3>";
                echo "<img src='" . htmlspecialchars($row['ruta_archivo']) . "' alt='" . htmlspecialchars($row['titulo']) . "'>";
                echo "</li>";
            }
        } else {
            echo "No se encontraron lotes.";
        }
        ?>
    </ul>
</body>
</html>

