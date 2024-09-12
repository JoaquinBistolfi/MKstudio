<?php

$conexion = mysqli_connect("localhost", "root", "", "proyecto") or die("Datos incorrectos");

$query = "SELECT * FROM `lotes` WHERE `titulo` LIKE '1 joaquin bien perritp'";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="especificaciones.css">
</head>
<body>
    <h1>Espcecificaciones del lote</h1>

    <H2>FORMULARIO DE DATOS</H2>
        <label for="">Agregar imagenes</label>
            <img src="../imagenes/agregar.png" alt="" style="height: 30px;">



    <div class="ordenar">
        <form action="" method="post">
            <label for="peso_max">Peso Máximo:</label>
            <input type="number" id="peso_max" name="peso_max" required>

            <label for="peso_min">Peso Mínimo:</label>
            <input type="number" id="peso_min" name="peso_min" required>

            <label for="porc_pesada">Porcentaje de Pesada:</label>
            <input type="number" id="porc_pesada" name="porc_pesada" required>

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" required>

            <label for="estado_reproductivo">Estado Reproductivo:</label>
            <input type="text" id="estado_reproductivo" name="estado_reproductivo" required>

            <label for="castrados">Castrados:</label>
            <input type="text" id="castrados" name="castrados" required>

            <label for="cantidad_raza">Cantidad de Raza:</label>
            <input type="text" id="cantidad_raza" name="cantidad_raza" required>

            <label for="edad">Edad:</label>
            <input type="text" id="edad" name="edad" required>

            <label for="sanidad">Sanidad:</label>
            <input type="text" id="sanidad" name="sanidad" required>

            <label for="trat_nutricional">Tratamiento Nutricional:</label>
            <input type="text" id="trat_nutricional" name="trat_nutricional" required>

            <label for="conoce_miOmio">Conoce MiOMiO:</label>
            <input type="text" id="conoce_miOmio" name="conoce_miOmio" required>

            <label for="zona_garrapata">Zona Garrapata:</label>
            <input type="text" id="zona_garrapata" name="zona_garrapata" required>

            <label for="trazabilidad">Trazabilidad:</label>
            <input type="text" id="trazabilidad" name="trazabilidad" required>

            <label for="destetados">Destetados:</label>
            <input type="text" id="destetados" name="destetados" required>

            <label for="mochos">Mochos:</label>
            <input type="text" id="mochos" name="mochos" required>

            <label for="observaciones">Observaciones:</label>
            <textarea id="observaciones" name="observaciones"></textarea>

            <label for="id_certificador">ID Certificador:</label>
            <input type="number" id="id_certificador" name="id_certificador" required>

            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
<script>
    
</script>
</html>
