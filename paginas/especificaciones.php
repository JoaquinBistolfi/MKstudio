<?php
include '../includes/conexion.php';

session_start();

@$rol_usuario = $_SESSION['rol'];

if (isset($_GET['id'])) {
    $lote_id = $_GET['id'];
    
    $sql = "SELECT * FROM lotes WHERE id_lote = '$lote_id'";
    $sql3 = "SELECT * FROM archivo WHERE id_lote = '$lote_id'";

    $result = mysqli_query($conexion, $sql);
    $result3 = mysqli_query($conexion, $sql3);
    
    if (mysqli_num_rows($result) > 0) {
        $lote = mysqli_fetch_assoc($result);
        $archivo = mysqli_fetch_assoc($result3);
    } else {
        echo "<p>No se encontró el lote.</p>";
    }

    $id_certificador = $lote['id_certificador'];

    $sql2 = "SELECT * FROM oferta WHERE id_lote = $lote_id ORDER BY monto DESC LIMIT 1";
    $result2 = mysqli_query($conexion, $sql2);

    $sql4 = "SELECT * FROM certificador WHERE id_certificador = '$id_certificador'";
    $result4 = mysqli_query($conexion, $sql4);

    if (mysqli_num_rows($result4) > 0) {
        $certificador = mysqli_fetch_assoc($result4);
    } else {
        echo "<p>No se encontró el certificador.</p>";
    }

    $sql_tiempo = "SELECT TIMESTAMPDIFF(SECOND, NOW(), fecha_fin) AS tiempo_restante_fin, TIMESTAMPDIFF(SECOND, NOW(), fecha_inicio) AS tiempo_restante_inicio FROM lotes WHERE id_lote = '$lote_id'";
    $result_tiempo = mysqli_query($conexion, $sql_tiempo);
    
    $tiempo_restante_fin = 0;
    $tiempo_restante_inicio = 0;
    if (mysqli_num_rows($result_tiempo) > 0) {
        $row_tiempo = mysqli_fetch_assoc($result_tiempo);
        $tiempo_restante_fin = $row_tiempo['tiempo_restante_fin'];
        $tiempo_restante_inicio = $row_tiempo['tiempo_restante_inicio'];
    }

} else {
    echo "<p>No se ha seleccionado ningún lote.</p>";
}

if(isset($_SESSION['oferta']) && $_SESSION['oferta'] == "echo") {
    echo "<script>alert('Oferta hecha correctamente');</script>";
    $_SESSION['oferta'] = "no";
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
<?php 
if ($rol_usuario == 'Administrador'){
    include '../includes/headeradmin.php';
} else {
    include '../includes/header.php';
}
?>
<body>
    <?php
    echo "<h1>Lote de " . $lote['cantidad'] . " " . $lote['categoria'] . "</h1>";
    ?>

    <div class="datos">
        <div class="imagenes">
            <?php
            echo "<img src='" . @$archivo['ruta'] . "' alt='" . $lote['categoria'] . "'>";
            ?>
        </div>

        <div class="oferta">
            <h2>Ofertas</h2>
            <?php
            if (isset($_SESSION['user_id'])) {
                if (mysqli_num_rows($result2) > 0) {
                    $oferta = mysqli_fetch_assoc($result2);
                    if ($oferta['id_usuario'] == $_SESSION['user_id']) {
                        echo '<p>La mayor oferta es: ' . $oferta['monto'] . '. Fue hecha por usted.</p>';
                    } else {
                        echo '<p>La mayor oferta es: ' . $oferta['monto'] . '</p>';
                    }             
                } else {
                    echo "<p>No hay ninguna oferta aun.</p>";
                }
                
                if($rol_usuario != 'Administrador'){
                    echo 
                    '
                        <p>Precio en dólares por kilo</p>
                    <form action="procesar_oferta.php" method="post">
                        <input type="hidden" name="lote_id" value="' . $lote['id_lote'] . '">
                        <label for="oferta">Ingrese su oferta:</label>
                        <input type="number" name="oferta" step=0.01 min=' . @$oferta['monto'] + 0.01 .' id="oferta" required>
                        <button type="submit">Enviar oferta</button>
                    </form>';
                }
                echo'
                <div class="cronometro">
                    <h2>Tiempo restante:</h2>
                    <div id="contador"></div>
                </div>';
            
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
            echo "<p>Categoría: " . @$lote['categoria'] . "</p>";
            echo "<p>Cantidad: " . @$lote['cantidad'] . "</p>";
            echo "<p>Peso promedio: " . @$lote['peso_promedio'] . "</p>";
            echo "<p>Peso máximo: " . @$lote['peso_maximo'] . "</p>";
            echo "<p>Peso mínimo: " . @$lote['peso_minimo'] . "</p>";
            echo "<p>Porcentaje pesado: " . @$lote['cant_pesada'] . "</p>";
            echo "<p>Estado: " . @$lote['estado'] . "</p>";
            echo "<p>Raza: " . @$lote['raza'] . "</p>";
            echo "<p>Edad: " . @$lote['edad'] . " meses.</p>";
            echo "<p>Sanidad: " . @$lote['sanidad'] . "</p>";
            echo "<p>Tratamiento nutricional: " . @$lote['tratamiento_nutricional'] . "</p>";
            echo "<p>Conoce Mio Mio: " . @$lote['conoce_miomio'] . "</p>";
            echo "<p>Zona garrapata: " . @$lote['zona_garrapata'] . "</p>";
            ?>
        </div>

        <div class="observaciones">
            <h2>Observaciones</h2>
            <?php
            echo "<p>Observaciones: " . @$lote['observaciones'] . "</p>";
            ?>
        </div>

        <div class="certificador">
            <h2>Certificador</h2>
            <?php
            echo "<p>Certificado por: " . $certificador['profesion'] . " " . $certificador['nombre'] . " " .  $certificador['apellido'] ."</p>";
            echo "<img src='" . $certificador['ruta_archivo'] . "' alt='" . $certificador['nombre'] . "'>";
            ?>
        </div>
    </div>

    <script>
        let tiempoRestanteInicio = <?php echo $tiempo_restante_inicio; ?>;
        let tiempoRestanteFin = <?php echo $tiempo_restante_fin; ?>;

        function formatoTiempo(segundos) {
            let horas = Math.floor(segundos / 3600);
            let minutos = Math.floor((segundos % 3600) / 60);
            let segundos_restantes = segundos % 60;

            horas = horas < 10 ? '0' + horas : horas;
            minutos = minutos < 10 ? '0' + minutos : minutos;
            segundos_restantes = segundos_restantes < 10 ? '0' + segundos_restantes : segundos_restantes;

            return horas + 'hr ' + minutos + 'min ' + segundos_restantes + 'seg';
        }

        function actualizarContador() {
            if (tiempoRestanteInicio > 0) {
                document.getElementById('contador').innerHTML = "Faltan: " + formatoTiempo(tiempoRestanteInicio) + " para que empiece";
                tiempoRestanteInicio--;
            } else if (tiempoRestanteFin > 0) {
                document.getElementById('contador').innerHTML = "Tiempo restante: " + formatoTiempo(tiempoRestanteFin);
                tiempoRestanteFin--;
            } else {
                clearInterval(intervalo);
                document.getElementById('contador').innerHTML = "¡Subasta finalizada!";
            }
        }

        let intervalo = setInterval(actualizarContador, 1000);
    </script>

</body>
<?php include '../includes/footer.php'; ?>
</html>
