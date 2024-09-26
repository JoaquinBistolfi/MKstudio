<?php
include '../includes/conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['categoria']) && isset($_FILES['archivo'])) {
    if (!empty($_POST["categoria"]) && !empty($_POST["cantidad"]) && !empty($_POST["peso"]) && !empty($_FILES["archivo"])) {
        $categoria = $_POST['categoria'];
        $raza = $_POST['raza'];
        $cantidad = $_POST['cantidad'];
        $peso = $_POST['peso'];
        $peso_max = $_POST['peso_max'];
        $peso_min = $_POST['peso_min'];
        $porc_pesada = $_POST['porc_pesada'];
        $estado = $_POST['estado'];
        $estado_reproductivo = $_POST['estado_reproductivo'];
        $castrados = $_POST['castrados'];
        $edad = $_POST['edad'];
        $sanidad = $_POST['sanidad'];
        $trat_nutricional = $_POST['trat_nutricional'];
        $destetados = $_POST['destetados'];
        $mochos = $_POST['mochos'];
        $observaciones = $_POST['observaciones'];
        $conoce_miomio = isset($_POST['conoce_miomio']) ? 1 : 0;
        $zona_garrapata = isset($_POST['zona_garrapata']) ? 1 : 0;
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
                $sql = "INSERT INTO lotes (Categoria, Cantidad_Raza, Cantidad, Peso_Prom, Peso_Max, Peso_Min, Porc_Pesada, Estado, Estado_Reproductivo, Castrados, Edad, Sanidad, Trat_Nutricional, Destetados, Mochos, Observaciones, Conoce_MiOMiO, Zona_Garrapata, Ruta_archivo) 
                        VALUES ('$categoria', '$raza', '$cantidad', '$peso', '$peso_max', '$peso_min', '$porc_pesada', '$estado', '$estado_reproductivo', '$castrados', '$edad', '$sanidad', '$trat_nutricional', '$destetados', '$mochos', '$observaciones', '$conoce_miomio', '$zona_garrapata', '$ruta_archivo')";
                
                if (mysqli_query($conexion, $sql)) {
                    header("Location: " . $_SERVER['PHP_SELF']);
                    $_SESSION['mail'] = "nuevolote";
                    exit;
                } else {
                    echo "Error al guardar los datos: " . mysqli_error($conexion);
                }
            } else {
                echo "Error al mover el archivo subido.";
            }
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}

$sql = "SELECT ID_Lote, Categoria, Cantidad_Raza, Cantidad, Peso_Prom, Ruta_archivo FROM lotes";
$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Lotes</title>
    <link rel="stylesheet" href="../css/lotes.css">
</head>
<?php include '../includes/header.php'; ?>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="info">
            <label for="categoria">Categoría:
                <input type="text" name="categoria" required>
            </label>
            <label for="raza">Raza:
                <input type="text" name="raza" required>
            </label>
            <label for="cantidad">Cantidad:
                <input type="number" name="cantidad" required>
            </label>
            <label for="peso">Peso Promedio:
                <input type="number" name="peso" required>
            </label>
            <label for="peso_max">Peso Máximo:
                <input type="number" name="peso_max">
            </label>
            <label for="peso_min">Peso Mínimo:
                <input type="number" name="peso_min">
            </label>
            <label for="porc_pesada">Porcentaje Pesada:
                <input type="number" name="porc_pesada">
            </label>
            <label for="estado">Estado:
                <input type="text" name="estado">
            </label>
            <label for="estado_reproductivo">Estado Reproductivo:
                <input type="text" name="estado_reproductivo">
            </label>
            <label for="castrados">Castrados:
                <input type="text" name="castrados">
            </label>
            <label for="edad">Edad:
                <input type="number" name="edad">
            </label>
            <label for="sanidad">Sanidad:
                <input type="text" name="sanidad">
            </label>
            <label for="trat_nutricional">Tratamiento Nutricional:
                <input type="text" name="trat_nutricional">
            </label>
            <label for="destetados">Destetados:
                <input type="text" name="destetados">
            </label>
            <label for="mochos">Mochos:
                <input type="text" name="mochos">
            </label>
            <label for="observaciones">Observaciones:
                <textarea name="observaciones"></textarea>
            </label>
            <label for="conoce_miomio">Conoce MiOMiO:
                <input type="checkbox" name="conoce_miomio" value="1">
            </label>
            <label for="zona_garrapata">Zona Garrapata:
                <input type="checkbox" name="zona_garrapata" value="1">
            </label>
        </div>
            <label for="foto_lote">Foto principal del lote:
                <input type="file" name="archivo" id="foto_lote" required accept=".jpg, .png">
            </label>
        
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
                <th>Raza</th>
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
                    echo "<td><a href='especificaciones.php?id=" . $row['ID_Lote'] . "'><img src='" . $row['Ruta_archivo'] . "' alt='" . $row['Categoria'] . "'></a></td>";  
                    echo "<td>" . $row['Categoria'] . "</td>";
                    echo "<td>" . $row['Cantidad_Raza'] . "</td>";
                    echo "<td>" . $row['Cantidad'] . "</td>";
                    echo "<td>" . $row['Peso_Prom'] . "</td>";
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
