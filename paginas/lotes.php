<?php
include '../includes/conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['categoria']) && isset($_FILES['archivo'])) {
    if (!empty($_POST["categoria"]) && !empty($_POST["cantidad"]) && !empty($_POST["peso"]) && !empty($_FILES["archivo"])) {
        $categoria = $_POST['categoria'];
        $raza = $_POST['raza'];
        $cantidad = $_POST['cantidad'];
        $peso = $_POST['peso'];
        $peso_maximo = $_POST['peso_maximo'];
        $peso_minimo = $_POST['peso_minimo'];
        $cant_pesada = $_POST['cant_pesada'];
        $estado = $_POST['estado'];
        $edad = $_POST['edad'];
        $sanidad = $_POST['sanidad'];
        $tratamiento_nutricional = $_POST['tratamiento_nutricional'];
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
                $sql_lotes = "INSERT INTO lotes (categoria, cantidad, peso_promedio, peso_maximo, peso_minimo, cant_pesada, estado, raza, edad, sanidad, tratamiento_nutricional, mochos, observaciones, conoce_miomio, zona_garrapata) 
                              VALUES ('$categoria', '$cantidad', '$peso', '$peso_maximo', '$peso_minimo', '$cant_pesada', '$estado', '$raza', '$edad', '$sanidad', '$tratamiento_nutricional', '$mochos', '$observaciones', '$conoce_miomio', '$zona_garrapata')";

                if (mysqli_query($conexion, $sql_lotes)) {
                    $id_lote = mysqli_insert_id($conexion);  

                    $sql_archivo = "INSERT INTO archivo (id_lote, ruta) VALUES ('$id_lote', '$ruta_archivo')";
                    if (mysqli_query($conexion, $sql_archivo)) {
                        header("Location: " . $_SERVER['PHP_SELF']);
                        $_SESSION['mail'] = "nuevolote";
                        exit;
                    } else {
                        echo "Error al guardar el archivo: " . mysqli_error($conexion);
                    }
                } else {
                    echo "Error al guardar el lote: " . mysqli_error($conexion);
                }
            } else {
                echo "Error al mover el archivo subido.";
            }
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}

$sql = "SELECT l.id_lote, l.categoria, l.raza, l.cantidad, l.peso_promedio, a.ruta 
        FROM lotes l 
        LEFT JOIN archivo a ON a.id_lote = l.id_lote;";

$result = mysqli_query($conexion, $sql);
if (!$result) {
    die("Error en la consulta SQL: " . mysqli_error($conexion));
}
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
    <h2>Agregar nuevo lote</h2>

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
            <label for="peso_maximo">Peso Máximo:
                <input type="number" name="peso_maximo">
            </label>
            <label for="peso_minimo">Peso Mínimo:
                <input type="number" name="peso_minimo">
            </label>
            <label for="cant_pesada">Porcentaje Pesada:
                <input type="number" name="cant_pesada">
            </label>
            <label for="estado">Estado:
                <input type="text" name="estado">
            </label>
            <label for="edad">Edad:
                <input type="number" name="edad">
            </label>
            <label for="sanidad">Sanidad:
                <input type="text" name="sanidad">
            </label>
            <label for="tratamiento_nutricional">Tratamiento Nutricional:
                <input type="text" name="tratamiento_nutricional">
            </label>
            <label for="mochos">Mochos:
                <input type="number" name="mochos">
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
                <th>Peso Promedio</th>
            </tr>
        </thead>
        <tbody>
            <div class="fila_tabla">
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><a href='especificaciones.php?id=" . $row['id_lote'] . "'><img src='" . $row['ruta'] . "' alt='" . $row['categoria'] . "'></a></td>";  
                        echo "<td>" . $row['categoria'] . "</td>";
                        echo "<td>" . $row['raza'] . "</td>";
                        echo "<td>" . $row['cantidad'] . "</td>";
                        echo "<td>" . $row['peso_promedio'] . "</td>";
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
