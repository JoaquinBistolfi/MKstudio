<?php

$conexion = mysqli_connect("localhost", "root", "", "proyecto") or die("Datos incorrectos");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['titulo']) && isset($_FILES['archivo'])) {
        if (!empty($_POST["titulo"]) && !empty($_FILES["archivo"])){

            $titulo = $_POST['titulo'];
            $foto_lote = $_FILES['archivo']['name'];

            if ($nombre_archivo != '') {
                $nombre_archivo_unico = $titulo . '_' . $foto_lote;
                $ruta_archivo = 'foto_lote/' . $titulo .'/' . $nombre_archivo_unico;
        
                if (!file_exists('foto_lote/' . $titulo'')) {
                    if (!mkdir('foto_lote/' . $titulo'', 0777, true)) {
                        die("Error al crear el directorio.");
                    }
                }
            }
        }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="titulo_lote">
            Titulo del lote:
            <input type="text" name="titulo" id="">
        </label>
        <label for="foto_lote">
            Foto principal del lote:
        <input type="file" name="archivo" required accept='.jpg , .png'>
        </label>
        <input type="button" value="">
    </form>
</body>
</html>