<?php
    session_start();
    require_once("pdo.php");

    if (isset($_SESSION["USER_AUTH"])) {
        header("Location: index.php");
        return;
    } else { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Registrarse - Usuarios y fotos de perfil</title>
            <link rel="stylesheet" href="style-form.css">
        </head>
        <body>
            <div class="container">
                <form action="" method="post" class="container-form">
                    <div class="content-form">
                        <div class="head-form-content">
                            <h1>Registrarse</h1>
                            <span><i>Ingrese los datos solicitados.</i></span>
                        </div>
                        <div class="body-form-content">
                            <label for="name">
                                Nombre completo<input type="text" name="name" id="name">
                            </label>
                            <label for="email">
                                Correo<input type="text" name="email" id="email">
                            </label>
                            <label for="pw">
                                Contraseña<input type="text" name="pw" id="pw">
                            </label>
                            <?php
                                if (isset($_SESSION["msg"])) {
                                    echo $_SESSION["msg"];
                                    unset($_SESSION["msg"]);
                                }
                            ?>
                        </div>
                        <div class="footer-form-content">
                            <button type="submit">Registrarme</button>
                            <button type="submit" name="cancel">Cancelar</button>
                        </div>
                    </div>
                </form>
                <div class="footer-container">
                    <div class="footer-content">
                        <i>Darlin Daniel Arias Méndez</i>
                    </div>
                </div>
            </div>
        </body>
        </html>
    <?php }
?>