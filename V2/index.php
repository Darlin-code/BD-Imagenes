<?php
    session_start();
    require_once("pdo.php");

    if (!isset($_SESSION["USER_AUTH"])) { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Usuarios y fotos de perfil</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <div class="container">
                <header class="header-container">
                    <div class="header-content">
                        <a href="login.php">Iniciar sesión</a>
                        <a href="register.php">Registrase</a>
                    </div>
                </header>
                <div class="body-container">
                    <i>Necesitas una cuenta para continuar.</i>
                </div>
                <footer class="footer-container">
                    <i>Darlin Daniel Arias Méndez</i>
                </footer>
            </div>
        </body>
        </html>
    <?php } else { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Usuarios y fotos de perfil</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <div class="container">
                <header class="header-container">
                    <div class="header-content">
                        <div class="user-content">
                            <a href="settings.php"><i class="fa-solid fa-user"></i></a>
                        </div>
                    </div>
                </header>
                <div class="body-container">
                    <i>Lo sentimos, actualmente no hay contenido que mostrar.</i>
                </div>
                <footer class="footer-container">
                    <i>Darlin Daniel Arias Méndez</i>
                </footer>
            </div>
        </body>
        </html>
    <?php }
?>