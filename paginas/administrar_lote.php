<?php
include '../includes/conexion.php';

session_start();
@$rol_usuario = $_SESSION['rol'];

if (isset($_GET['id'])) {
    $lote_id = $_GET['id'];
    
    $sql = "SELECT * FROM lotes, certificador WHERE id_lote = '$lote_id'";
    $result = mysqli_query($conexion, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $lote = mysqli_fetch_assoc($result);
        $fecha_fin = new DateTime($lote['fecha_fin']);
        $fecha_fin_formateada = $fecha_fin->format('Y-m-d H:i');
        $fecha_actual = new DateTime();
        $fecha_actual_formateada = $fecha_actual->format('Y-m-d H:i');
    } else {
        echo "<p>No se encontró el lote.</p>";
        exit;
    }
} else {
    echo "<p>No se ha seleccionado ningún lote.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoria = $_POST['categoria'];
    $cantidad = $_POST['cantidad'];
    $peso_promedio = $_POST['peso_promedio'];
    $peso_maximo = $_POST['peso_maximo'];
    $peso_minimo = $_POST['peso_minimo'];
    $cant_pesada = $_POST['cant_pesada'];
    $estado = $_POST['estado'];
    $raza = $_POST['raza'];
    $edad = $_POST['edad'];
    $sanidad = $_POST['sanidad'];
    $tratamiento_nutricional = $_POST['tratamiento_nutricional'];
    $conoce_miomio = $_POST['conoce_miomio'];
    $zona_garrapata = $_POST['zona_garrapata'];
    $observaciones = $_POST['observaciones'];
    $certificador = $_POST['certificador'];
    $vendido = isset($_POST['vendido']) ? 1 : 0;

    $update_sql = "UPDATE lotes SET 
    categoria='$categoria',
    cantidad='$cantidad',
    peso_promedio='$peso_promedio',
    peso_maximo='$peso_maximo',
    peso_minimo='$peso_minimo',
    cant_pesada='$cant_pesada',
    estado='$estado',
    raza='$raza',
    edad='$edad',
    sanidad='$sanidad',
    tratamiento_nutricional='$tratamiento_nutricional',
    conoce_miomio='$conoce_miomio',
    zona_garrapata='$zona_garrapata',
    observaciones='$observaciones',
    id_certificador='$certificador',
    vendido='$vendido'
    WHERE id_lote='$lote_id'";

    if (mysqli_query($conexion, $update_sql)) {
        echo "<p>Lote actualizado correctamente.</p>";
    } else {
        echo "<p>Error al actualizar el lote: " . mysqli_error($conexion) . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Lote</title>
    <link rel="stylesheet" href="../css/lotes.css">
</head>
<body>
<?php
    if ($rol_usuario == 'Administrador') {
        include '../includes/headeradmin.php';
    } else {
        header("Location: ../index.php");
    }
?>

<h2>Editar Lote de <?php echo $lote['cantidad'] . " " . $lote['categoria']; ?></h2>

<form action="administrar_lote.php?id=<?php echo $lote_id; ?>" method="post">
    <div class="info">
        <label for="categoria">Categoría:
        <input type="text" name="categoria" value="<?php echo $lote['categoria']; ?>" required>
        </label>

        <label for="cantidad">Cantidad:
        <input type="number" name="cantidad" value="<?php echo $lote['cantidad']; ?>" required>
        </label>

        <label for="peso_promedio">Peso promedio:
        <input type="number" name="peso_promedio" value="<?php echo $lote['peso_promedio']; ?>" required>
        </label>

        <label for="peso_maximo">Peso máximo:
        <input type="number" name="peso_maximo" value="<?php echo $lote['peso_maximo']; ?>" required>
        </label>

        <label for="peso_minimo">Peso mínimo:
        <input type="number" name="peso_minimo" value="<?php echo $lote['peso_minimo']; ?>" required>
        </label>

        <label for="cant_pesada">Porcentaje pesado:
        <input type="number" name="cant_pesada" value="<?php echo $lote['cant_pesada']; ?>" required>
        </label>

        <label for="estado">Estado:
        <input type="text" name="estado" value="<?php echo $lote['estado']; ?>" required>
        </label>

        <label for="raza">Raza:
        <input type="text" name="raza" value="<?php echo $lote['raza']; ?>" required>
        </label>

        <label for="edad">Edad (meses):
        <input type="number" name="edad" value="<?php echo $lote['edad']; ?>" required>
        </label>

        <label for="sanidad">Sanidad:
        <input type="text" name="sanidad" value="<?php echo $lote['sanidad']; ?>" required>
        </label>

        <label for="tratamiento_nutricional">Tratamiento nutricional:
        <input type="text" name="tratamiento_nutricional" value="<?php echo $lote['tratamiento_nutricional']; ?>" required>
        </label>

        <label for="conoce_miomio">Conoce Mio Mio:
        <input type="text" name="conoce_miomio" value="<?php echo $lote['conoce_miomio']; ?>" required>
        </label>

        <label for="zona_garrapata">Zona garrapata:
        <input type="text" name="zona_garrapata" value="<?php echo $lote['zona_garrapata']; ?>" required>
        </label>

        <label for="observaciones">Observaciones:
        <textarea name="observaciones" required><?php echo $lote['observaciones']; ?></textarea>
        </label>

        <label for="certificador">Certificador:
        <select name="certificador" required>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id_certificador'] . '">' . $row['nombre'] . " " . $row['apellido'] .'</option>';
                        }
                    } else {
                        echo '<option value="">No hay datos disponibles</option>';
                    }
                ?>
        </select>
        </label>
        
        <?php if ($fecha_actual > $fecha_fin): ?>
            <label for="vendido">Marcar como vendido:
                <input type="checkbox" name="vendido" <?php echo ($lote['vendido'] == 1) ? 'checked' : ''; ?>>
            </label>
        <?php endif; ?>
    </div>
    <div class="btn">
        <input type="submit" value="Actualizar">
    </div>
</form>

<?php include '../includes/footer.php'; ?>
</body>
</html>