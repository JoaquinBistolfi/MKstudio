<?php
session_start();

$url = "https://acg.com.uy"; 
$cacheFile = 'cache.html';
$cacheTime = 3600;

if (file_exists($cacheFile) && (time() - $cacheTime < filemtime($cacheFile))) {
    $html = file_get_contents($cacheFile);
} else {
    $html = file_get_contents($url);
    file_put_contents($cacheFile, $html);
}

$dom = new DOMDocument();
libxml_use_internal_errors(true); 
$dom->loadHTML($html);
libxml_clear_errors();

$xpath = new DOMXPath($dom);
$h3s = $xpath->query('//h3[contains(@class, "fz-x15") and contains(@class, "fw-800")]');

if ($h3s->length > 0) {
    $texts = [
        0 => ["label" => "Novillo", "img" => "../imagenes/novillo.png"],
        1 => ["label" => "Vaca", "img" => "../imagenes/vaca.png"],
        2 => ["label" => "Vaquillona", "img" => "../imagenes/vaquillona.png"],
        3 => ["label" => "Ternero", "img" => "../imagenes/ternero.png"],
        4 => ["label" => "Ternera", "img" => "../imagenes/ternera.png"],
        5 => ["label" => "Vaca invernada", "img" => "../imagenes/invernada.png"],
    ];

    $gordoData = [];
    $reposicionData = [];

    for ($i = 0; $i < 3; $i++) {
        $gordoData[] = (float) str_replace(',', '.', trim($h3s[$i]->nodeValue));
    }
    for ($i = 3; $i < 6; $i++) {
        $reposicionData[] = (float) str_replace(',', '.', trim($h3s[$i]->nodeValue));
    }

    @$rol_usuario = $_SESSION['rol'];

    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Precios de Ganado</title>
        <link rel="stylesheet" href="../css/estadisticas.css">
        <link rel="shortcut icon" href="../imagenes/logoico.ico" type="image/x-icon">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <?php 
    if ($rol_usuario == 'Administrador') {
        include '../includes/headeradmin.php';
    } else {
        include '../includes/header.php';
    }
    ?>
    <body>
        <h1 class="titulo">Precios consignatario</h1>
        <div class="container">
            <h2>Gordo</h2>
            <div class="card">
                <?php
                for ($i = 0; $i < 3; $i++) {
                    if (isset($texts[$i])) {
                        ?>
                        <div class="item">
                            <img src="<?php echo $texts[$i]['img']; ?>" alt="<?php echo $texts[$i]['label']; ?>">
                            <strong><?php echo $texts[$i]['label']; ?>:</strong> <?php echo $h3s[$i]->nodeValue; ?><span>Dólares por kilo en cuarta balanza</span>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <h2>Reposicion</h2>
            <div class="card">
                <?php
                for ($i = 3; $i < 6; $i++) {
                    if (isset($texts[$i])) {
                        ?>
                        <div class="item">
                            <img src="<?php echo $texts[$i]['img']; ?>" alt="<?php echo $texts[$i]['label']; ?>">
                            <strong><?php echo $texts[$i]['label']; ?>:</strong> <?php echo $h3s[$i]->nodeValue; ?><span>Dólares por kilo en pie</span>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class='graficas'>
            <canvas id="gordo"></canvas>
            <canvas id="reposicion"></canvas>
        </div>
        </div>
        
        <?php include '../includes/footer.php'; ?>
        
        <script>
            var gordoData = <?php echo json_encode($gordoData); ?>;
            var reposicionData = <?php echo json_encode($reposicionData); ?>;
            console.log("Datos Gordo:", gordoData);
            console.log("Datos Reposición:", reposicionData);

            var ctxGordo = document.querySelector('#gordo').getContext('2d');
            var graficaGordo = new Chart(ctxGordo, {
                type: 'bar',
                data: {
                    labels: ['Novillo', 'Vaca', 'Vaquillona'],
                    datasets: [{
                        label: 'Precios Gordo (USD por kg)',
                        backgroundColor: 'rgb(75, 192, 192)',
                        borderColor: 'rgb(75, 192, 192)',
                        data: gordoData
                    }]
                },
                options: {
                    scales: {
                        y: {
                            min: 2,
                            max: 5,
                            ticks: {
                                stepSize: 0.2
                            }
                        }
                    }
                }
            });

            var ctxReposicion = document.querySelector('#reposicion').getContext('2d');
            var graficaReposicion = new Chart(ctxReposicion, {
                type: 'bar',
                data: {
                    labels: ['Ternero', 'Ternera', 'Vaca invernada'],
                    datasets: [{
                        label: 'Precios Reposicion (USD por kg)',
                        backgroundColor: 'rgb(255, 159, 64)',
                        borderColor: 'rgb(255, 159, 64)',
                        data: reposicionData
                    }]
                },
                options: {
                    scales: {
                        y: {
                            min: 2,
                            max: 5,
                            ticks: {
                                stepSize: 0.2
                            }
                        }
                    }
                }
            });
        </script>
    </body>
    </html>
    <?php
} else {
    echo "No se encontraron h3 con esa clase.";
}
?>
