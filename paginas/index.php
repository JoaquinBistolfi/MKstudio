<?php 
session_start();

include '../includes/conexion.php';

@$rol_usuario = $_SESSION['rol'];
@$id_usuario = @$_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST["texto"])) {
        $texto = $_POST['texto'];

        $sql = "INSERT INTO `pregunta` (`contenido`, `fecha`, `id_usuario`)
        VALUES ('$texto', NOW(), '$id_usuario');";
        mysqli_query($conexion, $sql);
    }

    if (!empty($_POST["calificacion"]) && isset($_SESSION['user_id'])) {
        $calificacion = $_POST['calificacion'];
        $comentario = $_POST['comentario'];

        $query_check = "SELECT * FROM valoracion WHERE id_usuario = '$id_usuario'";
        $result_check = mysqli_query($conexion, $query_check);

        if (mysqli_num_rows($result_check) > 0) {
            $sql = "UPDATE valoracion SET calificacion = '$calificacion', comentario = '$comentario', fecha = NOW() WHERE id_usuario = '$id_usuario'";
        } else {
            $sql = "INSERT INTO valoracion (calificacion, comentario, fecha, id_usuario) VALUES ('$calificacion', '$comentario', NOW(), '$id_usuario')";
        }
        
        mysqli_query($conexion, $sql);
    }
}
    $sqlV = "SELECT u.nombre, u.apellido, v.calificacion, v.comentario, v.fecha 
        FROM valoracion AS v
        INNER JOIN usuarios AS u ON v.id_usuario = u.id_usuario
        ORDER BY v.fecha DESC";
    $resultV = $conexion->query($sqlV);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Da Rosa</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="shortcut icon" href="../imagenes/logoico.ico" type="image/x-icon">
</head>
<body>
    <?php 
    if ($rol_usuario == 'Administrador'){
        include '../includes/headeradmin.php';
    }else{
        include '../includes/header.php';
    }
    ?>

    <main>
        <section class="info_vaca">
            <div class="img_vaca">
                <ul>
                    <li><img src="../imagenes/loteangus.webp" alt="Imagen del lote Angus"></li>
                    <li><img src="../imagenes/lotebraford.jpg" alt="Imagen del lote Braford"></li>
                    <li><img src="../imagenes/lotepampa.jpeg" alt="Imagen del lote Pampa"></li>
                    <li><img src="../imagenes/novillonegro.jpg" alt="Imagen del lote Novillo Negro"></li>
                    <li><img src="../imagenes/gandado.jpg" alt="Imagen del ganado"></li>
                </ul>
            </div>

            <div class="caracteristicas">
                <h1>Características de los Lotes</h1>
                <div class="cartas">
                    <div class="card">
                        <img src="../imagenes/loteangus.webp" class="img" alt="Lote Angus">
                        <div class="details">
                            <h2>Información sobre el ganado</h2>
                            <p>En nuestro remate de ganado, ofrecemos una amplia variedad de lotes, adaptados a las necesidades de nuestros clientes. Cada lote tiene información detallada sobre su peso, edad y características, lo que permite a los compradores tomar decisiones informadas.</p>
                        </div>
                    </div>

                    <div class="card">
                        <img src="../imagenes/novillonegro.jpg" class="img" alt="Novillo Negro">
                        <div class="details">
                            <h2>Información sobre la empresa:</h2>
                            <p>Contamos con un equipo profesional altamente capacitado y comprometido con la excelencia en el servicio.Además, nos enorgullece colaborar con productores locales y nacionales, promoviendo el desarrollo del sector ganadero. Nuestro objetivo es ofrecer una plataforma moderna y accesible, facilitando el acceso a precios competitivos y un mercado en constante crecimiento.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="uc">
            <div class="ubi">
                <h2>¿Dónde está el ganado?</h2>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6570.5556628436725!2d-57.83396411929425!3d-31.03110519642315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1ses!2suy!4v1726067850907!5m2!1ses!2suy" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            
            <div class="consultas">
                <h2>¡Contáctese con nosotros!</h2>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '
                    <form action="" method="post">
                        <textarea name="text" class="contact-textarea" placeholder="Escribe tu mensaje aquí..."></textarea>
                        <input type="submit" value="Enviar pregunta">
                    </form>';
                } else {
                    echo '
                    <p>Debes iniciar sesión para hacer una pregunta.</p>
                    <a href="inicio_sesion.php"><button class="btn-login">Iniciar sesión</button></a>';
                }
                ?>
            </div>
        </section>
        <div class="valoraciones-container">
            <?php if ($rol_usuario != 'Administrador'): ?>
                <div class="valoracion" id="valoracionSection">
                    <h2>¡Valora nuestra página!</h2>
                    
                    <?php if (isset($_SESSION['user_id'])): 
                        $query_valoracion = "SELECT * FROM valoracion WHERE id_usuario = '$id_usuario'";
                        $result_valoracion = mysqli_query($conexion, $query_valoracion);
                        $valoracion_existente = mysqli_fetch_assoc($result_valoracion);

                        $calificacion = $valoracion_existente['calificacion'] ?? '';
                        $comentario = $valoracion_existente['comentario'] ?? ''; ?>

                        <form action="" method="post" id="formValoracion" class="<?php echo $valoracion_existente ? 'blurred' : ''; ?>">
                            <label>Calificación:</label>
                            <div class="rating">
                                <input type="radio" name="calificacion" id="star5" value="5" <?php echo ($calificacion == 5) ? 'checked' : ''; ?>><label for="star5" title="5 estrellas"></label>
                                <input type="radio" name="calificacion" id="star4" value="4" <?php echo ($calificacion == 4) ? 'checked' : ''; ?>><label for="star4" title="4 estrellas"></label>
                                <input type="radio" name="calificacion" id="star3" value="3" <?php echo ($calificacion == 3) ? 'checked' : ''; ?>><label for="star3" title="3 estrellas"></label>
                                <input type="radio" name="calificacion" id="star2" value="2" <?php echo ($calificacion == 2) ? 'checked' : ''; ?>><label for="star2" title="2 estrellas"></label>
                                <input type="radio" name="calificacion" id="star1" value="1" <?php echo ($calificacion == 1) ? 'checked' : ''; ?>><label for="star1" title="1 estrella"></label>
                            </div>

                            <label for="comentario">Comentario:</label>
                            <textarea name="comentario" rows="4" required><?php echo htmlspecialchars($comentario); ?></textarea>
                            
                            <input type="submit" value="Enviar valoración">
                        </form>
                    <?php else: ?>
                        <div class="centro">
                            <p>Debes iniciar sesión para dejar una valoración.</p>
                            <a href="inicio_sesion.php"><button class="btn-login">Iniciar sesión</button></a>
                        </div>
                    <?php endif;
                    if (@$valoracion_existente): ?>
                        <button class="editar-valoracion-btn" id="btn-edit" onclick="habilitarEdicion()">Editar valoración</button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="valoraciones-otros">
                <h2>Valoraciones de otros usuarios</h2>
                <div class="valoraciones-scroll">
                    <?php if ($resultV->num_rows > 0): ?>
                        <?php while($row = $resultV->fetch_assoc()): ?>
                            <p><strong><?php echo htmlspecialchars($row['nombre'] . " " . $row['apellido']); ?>:</strong></p>
                            <p>
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <span class='estrella <?php echo $i < $row['calificacion'] ? "llena" : "vacia"; ?>'>&#9733;</span>
                                <?php endfor; ?>
                            </p>
                            <p><?php echo htmlspecialchars($row['comentario']); ?></p>
                            <small><?php echo htmlspecialchars($row['fecha']); ?></small><hr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No hay valoraciones aún.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
<script src="../js/funciones.js"></script>
</body>
</html>