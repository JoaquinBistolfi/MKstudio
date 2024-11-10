<?php
include '../includes/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['categoria']) && isset($_FILES['archivos'])) {
    if (!empty($_POST["categoria"]) && !empty($_POST["cantidad"]) && !empty($_POST["peso"]) && !empty($_FILES["archivos"])) {
        $categoria = $_POST['categoria'];
        $raza = $_POST['raza'];
        $cantidad = $_POST['cantidad'];
        $peso = $_POST['peso'];
        $peso_maximo = $_POST['peso_maximo'];
        $peso_minimo = $_POST['peso_minimo'];
        $cant_pesada = $_POST['cant_pesada'];
        $estado = $_POST['estado'];
        $edad = $_POST['edad'];
        $clase = $_POST['clase'];
        $sanidad = $_POST['sanidad'];
        $tratamiento_nutricional = $_POST['tratamiento_nutricional'];
        $observaciones = $_POST['observaciones'];
        $conoce_miomio = isset($_POST['conoce_miomio']) ? 1 : 0;
        $zona_garrapata = isset($_POST['zona_garrapata']) ? 1 : 0;
        $fecha_ini = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_finalizacion'];
        $certificador = $_POST['certificador'];

        $nombre_carpeta = 'foto_lote/' . $categoria . '_' . $cantidad . '_' . $peso;
        if (!file_exists($nombre_carpeta)) {
            if (!mkdir($nombre_carpeta, 0777, true)) {
                die("Error al crear el directorio.");
            }
        }

        $sql_lotes = "INSERT INTO lotes (categoria, cantidad, peso_promedio, peso_maximo, peso_minimo, cant_pesada, estado, raza, edad, clase, sanidad, tratamiento_nutricional, observaciones, conoce_miomio, zona_garrapata, fecha_inicio, fecha_fin, id_certificador) 
                      VALUES ('$categoria', '$cantidad', '$peso', '$peso_maximo', '$peso_minimo', '$cant_pesada', '$estado', '$raza', '$edad', '$clase', '$sanidad', '$tratamiento_nutricional', '$observaciones', '$conoce_miomio', '$zona_garrapata', '$fecha_ini', '$fecha_fin', '$certificador')";

        if (mysqli_query($conexion, $sql_lotes)) {
            $id_lote = mysqli_insert_id($conexion);

            foreach ($_FILES['archivos']['tmp_name'] as $index => $tmp_name) {
                $nombre_archivo = $_FILES['archivos']['name'][$index];
                $ruta_archivo = $nombre_carpeta . '/' . basename($nombre_archivo);

                if (move_uploaded_file($tmp_name, $ruta_archivo)) {
                    $tipo = pathinfo($ruta_archivo, PATHINFO_EXTENSION) === 'mp4' ? 'video' : 'imagen';

                    $sql_archivo = "INSERT INTO archivo (id_lote, ruta, tipo) VALUES ('$id_lote', '$ruta_archivo', '$tipo')";
                    if (!mysqli_query($conexion, $sql_archivo)) {
                        echo "Error al guardar el archivo: " . mysqli_error($conexion);
                    }
                } else {
                    echo "Error al mover el archivo: " . $nombre_archivo;
                }
            }

            header("Location: " . $_SERVER['PHP_SELF']);
            $_SESSION['mail'] = "nuevolote";
            exit;
        } else {
            echo "Error al guardar el lote: " . mysqli_error($conexion);
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}

$sql = "SELECT 
            lotes.id_lote, 
            lotes.categoria, 
            lotes.raza, 
            lotes.cantidad, 
            lotes.peso_promedio, 
            MIN(archivo.ruta) AS ruta 
        FROM 
            lotes 
        LEFT JOIN 
            archivo ON lotes.id_lote = archivo.id_lote 
        WHERE 
            fecha_fin > NOW()
            AND lotes.vendido = 0
        GROUP BY 
            lotes.id_lote";

$result = mysqli_query($conexion, $sql);
if (!$result) {
    die("Error en la consulta SQL: " . mysqli_error($conexion));
}

@$rol_usuario = $_SESSION['rol'];

$sql_cert = "SELECT * FROM certificador;";
$result_cert = mysqli_query($conexion, $sql_cert);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Lotes</title>
    <link rel="stylesheet" href="../css/lotes.css">
    <script src="../js/borrarlote.js"></script>
</head>
<?php 
    if ($rol_usuario == 'Administrador'){
        include '../includes/headeradmin.php';
    } else {
        include '../includes/header.php';
    }
?>
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
                <input type="number" name="peso_maximo" required>
            </label>
            <label for="peso_minimo">Peso Mínimo:
                <input type="number" name="peso_minimo" required>
            </label>
            <label for="cant_pesada">Porcentaje Pesada:
                <input type="number" name="cant_pesada" required>
            </label>
            <label for="estado">Estado:
                <input type="text" name="estado" required>
            </label>
            <label for="edad">Edad:
                <input type="number" name="edad" required>
            </label>
            <label for="sanidad">Sanidad:
                <input type="text" name="sanidad" required>
            </label>
            <label for="Clase">Clase:
                <input type="text" name="clase" required>
            </label>
            <label for="tratamiento_nutricional">Tratamiento Nutricional:
                <input type="text" name="tratamiento_nutricional" required>
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
            <label for="fecha_inicio">Fecha de inicio:
                <input type="datetime-local" name="fecha_inicio" required>
            </label>
            <label for="fecha_finalizacion">Fecha de finalizacion:
                <input type="datetime-local" name="fecha_finalizacion" required>
            </label>
            <label for="certificador">Elegir certificador:
                <select name="certificador" required>
                <?php
                    if ($result_cert->num_rows > 0) {
                        while ($row = $result_cert->fetch_assoc()) {
                            echo '<option value="' . $row['id_certificador'] . '">' . $row['nombre'] . " " . $row['apellido'] .'</option>';
                        }
                    } else {
                        echo '<option value="">No hay datos disponibles</option>';
                    }
                    ?>
                </select>
            </label>
        </div>
        <label for="foto_lote">Fotos/Videos del lote:
                <input type="file" name="archivos[]" id="foto_lote" required accept=".jpg, .png, .mp4" multiple>
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
                <th class='esconder'>Foto</th>
                <th class='esconder'>Categoría</th>
                <th class='esconder'>Raza</th>
                <th class='esconder'>Cantidad</th>
                <th class='esconder'>Peso Promedio</th>
                <th class='aparecer'>Lote</th>
            </tr>
        </thead>
        <tbody>
            <div class="fila_tabla">
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td class='esconder'><a href='administrar_lote.php?id=" . $row['id_lote'] . "'><img src='" . $row['ruta'] . "' alt='" . $row['categoria'] . "' class='imagen'></a></td>";  
                        echo "<td class='esconder'>" . $row['categoria'] . "</td>";
                        echo "<td class='esconder'>" . $row['raza'] . "</td>";
                        echo "<td class='esconder'>" . $row['cantidad'] . "</td>";
                        echo "<td class='esconder'>" . $row['peso_promedio'] . "</td>";
                        echo "<td class='aparecer'>"  . $row['cantidad'] . ' ' . $row['categoria'] . "</td>";
                        echo "<td ><img src='../imagenes/borrar.png' alt='" . $row['categoria'] . "' onclick='borrarlote(" . $row['id_lote'] . ")' class='borrar'></td>";
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