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

    @$rol_usuario = $_SESSION['rol'];

    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Precios de Ganado</title>
        <link rel="stylesheet" href="../css/estadisticas.css">
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
        </div>
        <?php include '../includes/footer.php'; ?>
    </body>
    </html>
    <?php
} else {
    echo "No se encontraron h3 con esa clase.";
}
?>
