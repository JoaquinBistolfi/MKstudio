<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicación del Lote</title>
    <link rel="stylesheet" href="../css/publicacion.css">
</head>
<body>
<?php include('../includes/header.php'); ?>
    <div class="container">
        <div class="video-container">
            <video id="lote-video" controls>
                <source src="videovacas.mp4" type="video/mp4">
                Tu navegador no soporta el elemento de video.
            </video>
        </div>
        <div class="info-lotes">
            <h1></h1>
            <p>Oferta de subasta actual: </p>
            <p>Descripción: </p>
            <p>Entrega prevista: </p>
            <div class="acciones">
                <button>Hacer una oferta</button>
            </div>
        </div>
    </div>
<?php include('../includes/footer.php'); ?>
</body>
</html>
