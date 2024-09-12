<?php
$conexion = mysqli_connect("localhost", "root", "", "proyecto");

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['categoria']) && isset($_FILES['archivo'])) {
    if (!empty($_POST["categoria"]) && !empty($_POST["cantidad"]) && !empty($_POST["peso"]) && !empty($_FILES["archivo"])) {
        $categoria = $_POST['categoria'];
        $cantidad = $_POST['cantidad'];
        $peso = $_POST['peso'];
        $foto_lote = $_FILES['archivo']['name'];
        $tmp_name = $_FILES['archivo']['tmp_name'];

        if ($foto_lote != '') {
            $nombre_carpeta = 'foto_lote/' . $categoria . '_' . $cantidad . '_' . $peso;
            if (!file_exists($nombre_carpeta)) {
                if (!mkdir($nombre_carpeta, 0777, true)) {
                    die("Error al crear el directorio.");
                }
            }

            $ruta_archivo = $nombre_carpeta . '/' . basename($foto_lote);

            if (move_uploaded_file($tmp_name, $ruta_archivo)) {
                $sql = "INSERT INTO lotes (Categoria, Cantidad, Peso_Prom, Ruta_archivo) 
                        VALUES ('$categoria', '$cantidad', '$peso', '$ruta_archivo')";
                
                if (mysqli_query($conexion, $sql)) {
                    echo "Datos ingresados correctamente.";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit;
                } else {
                    echo "Error al guardar los datos: " . mysqli_error($conexion);
                }
            } else {
                echo "Error al mover el archivo subido.";
            }
        } else {
            echo "No se ha seleccionado ningún archivo.";
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}

$sql = "SELECT Categoria, Cantidad, Peso_Prom, Ruta_archivo FROM lotes";
$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Lotes</title>
    <link rel="stylesheet" href="lotes.css">
</head>
<body>
    <header>
        <input type="checkbox" id="activar" class="header_checkbox">
        <label for="activar" class="abrir_menu" role="button">=</label>
        <a href="../main.html"><img class="header_logo" src="../imagenes/darosa.png" alt="logo de la empresa"></a>
        <nav class="header_nav">
            <ul class="header_nav_lista">
                <li class="header_nav_link"><a href="#">Calendario</a></li>
                <li class="header_nav_link"><a href="#">Mis ofertas</a></li>
                <li class="header_nav_link"><a href="/header/lotes.php">Lotes</a></li>
            </ul>
        </nav>
    </header>
    
    <form action="" method="post" enctype="multipart/form-data">
        <div class="info">
            <label for="categoria">
                Categoría:
                <input type="text" name="categoria" required>
            </label>
            <label for="cantidad">
                Cantidad:
                <input type="number" name="cantidad" required>
            </label>
            <label for="peso">
                Peso:
                <input type="number" name="peso" required>
            </label>
            <label for="foto_lote">
                Foto principal del lote:
                <input type="file" name="archivo" id="foto_lote" required accept=".jpg, .png">
            </label>
        </div>
        <div class="btn">
            <input type="submit" value="Subir">
        </div>
    </form>

    <h2>Lista de lotes subidos</h2>
    <table class="listas">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Peso</th>
            </tr>
        </thead>
        <tbody>
        <div class="fila_tabla">
        <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><a href='especificaciones.php'><img src='" . $row['Ruta_archivo'] . "' alt='" . $row['Categoria'] . "'></a></td>";
                    echo "<td>" . $row['Categoria'] . "</td>";
                    echo "<td>" . $row['Cantidad'] . "</td>";
                    echo "<td>" . $row['Peso_Prom'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron lotes.</td></tr>";
            }
            ?>
        </div>
        </tbody>
    </table>
</body>
</html>
