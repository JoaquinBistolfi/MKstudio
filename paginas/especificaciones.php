<?php
include '../includes/conexion.php';

session_start();

if (isset($_GET['id'])) {
    $lote_id = $_GET['id'];
    
    $sql = "SELECT * FROM lotes WHERE ID_Lote = '$lote_id'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        $lote = mysqli_fetch_assoc($result);
    } else {
        echo "<p>No se encontró el lote.</p>";
    }

    $sql = "SELECT * FROM oferta";
    $result2 = mysqli_query($conexion, $sql);

} else {
    echo "<p>No se ha seleccionado ningún lote.</p>";
}

$_SESSION['lote_id'] = $lote_id;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especificaciones del Lote</title>
    <link rel="stylesheet" href="../css/especificaciones.css">
</head>
<body>
    <?php
    echo "<h1>Lote de " . $lote['Cantidad'] . " " . $lote['Categoria'] . "</h1>"
    ?>
    <div class="datos">
        <div class="imagenes">
            <?php
            echo "<img src='" . $lote['Ruta_archivo'] . "' alt='" . $lote['Categoria'] . "'>";
            ?>
        </div>
        <div class="oferta">
            <h2>Ofertas</h2>
            <?php
        
            if (mysqli_num_rows($result2) > 0) {
                $oferta = mysqli_fetch_assoc($result2);
            } else {
                echo "<p>No hay ninguna oferta aun.</p>";
            }
            
             if (isset($_SESSION['user_id'])) {
                echo '
                <form action="procesar_oferta.php" method="post">
                    <input type="hidden" name="lote_id" value="' . $lote['ID_Lote'] . '">
                    <label for="oferta">Ingrese su oferta:</label>
                    <input type="number" name="oferta" id="oferta" required>
                    <button type="submit">Enviar oferta</button>
                </form>';
            } else {
                echo '
                <p>Debes iniciar sesión para hacer una oferta.</p>
                <a href="inicio_sesion.php"><button>Iniciar sesión</button></a>';
            }
            ?>
        </div>
        <div class="informacion">
            <h2>Información</h2>
            <?php
            echo "<p>Categoría: " . $lote['Categoria'] . "</p>";
            echo "<p>Raza: " . $lote['Cantidad_Raza'] . "</p>";
            echo "<p>Cantidad: " . $lote['Cantidad'] . "</p>";
            echo "<p>Peso promedio: " . $lote['Peso_Prom'] . "</p>";
            echo "<p>Peso máximo: " . $lote['Peso_Max'] . "</p>";
            echo "<p>Peso mínimo: " . $lote['Peso_Min'] . "</p>";
            echo "<p>Porcentaje pesado: " . $lote['Porc_Pesada'] . "</p>";
            echo "<p>Estado: " . $lote['Estado'] . "</p>";
            echo "<p>Estado reproductivo: " . $lote['Estado_Reproductivo'] . "</p>";
            echo "<p>Castrados: " . $lote['Castrados'] . "</p>";
            echo "<p>Raza: " . $lote['Cantidad_Raza'] . "</p>";
            echo "<p>Edad: " . $lote['Edad'] . "</p>";
            echo "<p>Sanidad: " . $lote['Sanidad'] . "</p>";
            echo "<p>Tratamiento nutricional: " . $lote['Trat_Nutricional'] . "</p>";
            echo "<p>Conoce Mio Mio: " . $lote['Conoce_MiOMiO'] . "</p>";
            echo "<p>Zona garrapata: " . $lote['Zona_Garrapata'] . "</p>";
            echo "<p>Trazabilidad: " . $lote['Trazabilidad'] . "</p>";
            echo "<p>Destetados: " . $lote['Destetados'] . "</p>";
            echo "<p>Mochos: " . $lote['Mochos'] . "</p>";
            ?>
        </div>
        <div class="observaciones">
            <h2>Observaciones</h2>
            <?php
            echo "<p>Observaciones: " . $lote['Observaciones'] . "</p>";
            ?>
        </div>
        <div class="certificador">
            <h2>certificador</h2>
            <?php
            echo "<p>"
            ?>
        </div>
    </div>
</body>
</html>