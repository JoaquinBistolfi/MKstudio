<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Da Rosa</title>
    <link rel="stylesheet" href="/css/lotes.css">
    <link rel="shortcut icon" href="/imagenes/logoico.ico" type="image/x-icon">
</head>
<body>
<?php
session_start();
include './includes/header.php';
?>

    <!-- lista de lotes dinamica(esto mostrara la cantidad de lotes que hay en la base de datos) -->
    <div class="lista-columna">
        <ul>
            <?php
            // ejemplo de datos de la base de datos
            $lotes = [
                ["numero" => 1, "imagen" => "imagen1.jpg", "cantidad_vacas" => 10],
                ["numero" => 2, "imagen" => "imagen2.jpg", "cantidad_vacas" => 15],
                ["numero" => 3, "imagen" => "imagen3.jpg", "cantidad_vacas" => 20],
            ];

            // Aparece una fila por datos de lotes
            foreach ($lotes as $lote) {
                echo "<li>";
                echo "<img src='imagenes/{$lote["imagen"]}' alt='Imagen del lote {$lote["numero"]}'>";
                echo "<div>";
                echo "<h4>Número de lote: {$lote["numero"]}</h4>";
                echo "<p>Cantidad de vacas: {$lote["cantidad_vacas"]}</p>";
                // Si agregamos mas cosas las ponemos aca
                echo "</div>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>

    <?php
session_start();
include './includes/footer.php';
?>
</body>
</html>

