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
    <?php include '../includes/header.php'; ?>
    <main class="info_vaca">
        <div class="img_vaca">
            <ul>
                <li><img src="../imagenes/loteangus.webp" alt=""></li>
                <li><img src="../imagenes/lotebraford.jpg" alt=""></li>
                <li><img src="../imagenes/lotepampa.jpeg" alt=""></li>
                <li><img src="../imagenes/novillonegro.jpg" alt=""></li>
                <li><img src="../imagenes/gandado.jpg" alt=""></li>
            </ul>
        </div>
        <div class="caracteristicas">
            <h1>CARACTERISTICAS DE LOTES</h1>

            <div class="cartas">
                <div class="card">
                    <img src="../imagenes/loteangus.webp" class="img">
                    <div class="details">
                        <h2>Novillos negros</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum autem culpa consequatur! Eaque beatae, minus eum maxime quos assumenda ad officiis quam maiores eveniet dignissimos repudiandae quibusdam quia, cum consequuntur.</p>
                    </div>
                </div>

                <div class="card2">
                    <img src="../imagenes/novillonegro.jpg" class="img">
                    <div class="details">
                        <h2>Novillos angus</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat eaque itaque blanditiis ea facilis accusamus nesciunt, eum facere sapiente nulla vitae tempora eius illum minima possimus reprehenderit laudantium voluptas sunt.</p>
                    </div>
                </div>
            </div>
        </div>
     <div class="uc">
        <div class="ubi">
            <h2>Donde esta el ganado.</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6570.5556628436725!2d-57.83396411929425!3d-31.03110519642315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1ses!2suy!4v1726067850907!5m2!1ses!2suy" style="border:0;" allowfullscreen="" loading="lazy"></iframe>        
        </div>
        <div class="consultas">
            <h2>¡Contactese con nosotros!</h2>
           <form>
            <input placeholder="Nombre Completo*" name="nombre" type="text" required>
            <input placeholder="Telefono*" name="telefono" type="text" required>
            <input placeholder="Mensaje" name="texto" type="text" required>
            <input type="submit">
           </form>
        </div>
    </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>