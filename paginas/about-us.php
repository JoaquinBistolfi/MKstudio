<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../css/styleAU.css">
</head>
<body>
    <header>
        <div class="language-switcher">
            <select id="languageSelect" onchange="changeLanguage()">
                <option value="es" selected>Español</option>
                <option value="en">English</option>
            </select>
        </div>
        <h1 id="headerTitle">Sobre Nosotros</h1>
        <img src="../imagenes/mkstudio.jpg" alt="Logo de la empresa" class="logo">
    </header>

    <section class="about-us">
        <div class="content">
            <div class="text lang es">
                <h2>Nuestro Equipo</h2>
                <div class="integrantes">
                    <div class="integrante">
                        <img src="../imagenes/felipe.jpg" alt="Integrante 1: Felipe Castillo">
                        <p>Felipe Castillo</p>
                        <li class="linkedin_link"><a href="https://www.linkedin.com/in/felipe-castillo-837718327/">Linkedin</a></li>
                    </div>
                    <div class="integrante">
                        <img src="../imagenes/mateo.jpg" alt="Integrante 2: Mateo Da Rosa">
                        <p>Mateo Da Rosa</p>
                        <li class="linkedin_link"><a href="https://www.linkedin.com/in/felipe-castillo-837718327/">Linkedin</a></li>
                    </div>
                    <div class="integrante">
                        <img src="../imagenes/mimo.jpg" alt="Integrante 3: Joaquin Bistolfi">
                        <p>Joaquin Bistolfi</p>
                        <li class="linkedin_link"><a href="https://www.linkedin.com/in/felipe-castillo-837718327/">Linkedin</a></li>
                    </div>
                </div>
                
                <h2>Nuestra Misión</h2>
                <p>Somos una empresa que satisface a nuestros clientes mediante el desarrollo de software brindando eficacia y sencillez.</p>

                <h2>Nuestra Visión</h2>
                <p>Ser la empresa líder en desarrollo web del Uruguay, facilitando a la sociedad el acceso a la información y servicios que necesitan a través de internet.</p>

                <h2>Contacta con Nosotros</h2>
                <p>Para más información o cualquier consulta, no dudes en contactarnos. mkstudio3be@gmail.com</p>
            </div>

            <div class="text lang en" style="display:none;">
                <h2>Our Team</h2>
                <div class="integrantes">
                    <div class="integrante">
                        <img src="../imagenes/felipe.jpg" alt="Team Member 1: Felipe Castillo">
                        <p>Felipe Castillo</p>
                        <li class="linkedin_link"><a href="https://www.linkedin.com/in/felipe-castillo-837718327/">LinkedIn</a></li>
                    </div>
                    <div class="integrante">
                        <img src="../imagenes/mateo.jpg" alt="Team Member 2: Mateo Da Rosa">
                        <p>Mateo Da Rosa</p>
                        <li class="linkedin_link"><a href="https://www.linkedin.com/in/felipe-castillo-837718327/">LinkedIn</a></li>
                    </div>
                    <div class="integrante">
                        <img src="../imagenes/mimo.jpg" alt="Team Member 3: Joaquin Bistolfi">
                        <p>Joaquin Bistolfi</p>
                        <li class="linkedin_link"><a href="https://www.linkedin.com/in/felipe-castillo-837718327/">LinkedIn</a></li>
                    </div>
                </div>
                
                <h2>Our Mission</h2>
                <p>We are a company that satisfies our clients by developing software that offers efficiency and simplicity.</p>

                <h2>Our Vision</h2>
                <p>To be the leading web development company in Uruguay, providing society with access to the information and services they need through the internet.</p>

                <h2>Contact Us</h2>
                <p>For more information or any queries, don't hesitate to contact us at mkstudio3be@gmail.com</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 MKstudio. Todos los derechos reservados.</p>
    </footer>

    <script src="../js/scriptAU.js"></script>
</body>
</html>