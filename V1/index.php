<?php
    session_start();
    require_once("pdo.php");

    if (isset($_FILES["img"])) {
        if ($_FILES["img"]["size"] !== 0) {
            $query = "INSERT INTO files (file, user_id) VALUES (:fl, :uid);";
            $insertar_file = $pdo -> prepare($query);
            $insertar_file -> execute(array(
                ':fl' => base64_encode(file_get_contents($_FILES["img"]["tmp_name"])),
                ':uid' => $_SESSION["USER_AUTH_UID"]
            ));
            $_SESSION["msg"] = "<p style='color: green'>Archivo añadido.</p>";
            header("Location: index.php");
            return;
        } else {
            $_SESSION["msg"] = "<p style='color: red'>Elija un archivo.</p>";
            header("Location: index.php");
            return;
        }
    }

    if (!isset($_SESSION["USER_AUTH"])) { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Subiendo imagenes</title>
        </head>
        <body>
            <h1>Por favor, inicie sesión.</h1>
            <span>Es necesario que <a href="login.php">inicie sesión</a> para continuar.</span>
        </body>
        </html>
    <?php } else { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Subiendo imagenes</title>
        </head>
        <style>
            .container-img {
                width: 85%;
                margin: 0 auto;
                display: flex;
                flex-direction: row;
                gap: 10px;
                flex-wrap: wrap;
            }

            .container-img img {
                width: 200px;
                height: 200px;
                object-fit: contain;
                /*clip-path: circle(60%);*/
            }

            .container-img:has(i) {
                margin-top: 100px;
                justify-content: center;
                align-items: center;
            }
        </style>
        <body>
            <h1>Bienvenido, <?= $_SESSION["USER_AUTH_EMAIL"] ?></h1>
            <hr>
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <h3>Subir imagen:</h3>
                <?php
                    if (isset($_SESSION["msg"])) {
                        echo $_SESSION["msg"];
                        unset($_SESSION["msg"]);
                    }
                ?>
                <label for="">
                    <input type="file" name="img" id="img" accept="image/*">
                </label><br><br>
                <button type="submit" style="margin-bottom: 20px;">Subir</button>
            </form>
            <hr>
            <h3>Mis imagenes:</h3>
            <div class="container-img">
                <?php
                    $query = "SELECT COUNT(*) conteo FROM files WHERE user_id = :uid;";
                    $query_img = $pdo -> prepare($query);
                    $query_img -> execute(array(
                        ':uid' => $_SESSION["USER_AUTH_UID"]
                    ));
                    $img_count = $query_img -> fetch(PDO::FETCH_ASSOC);
                
                    if ($img_count["conteo"] !== 0) {
                        $query = "SELECT file FROM files WHERE user_id = :uid;";
                        $extraer_img = $pdo -> prepare($query);
                        $extraer_img -> execute(array(
                        ':uid' => $_SESSION["USER_AUTH_UID"]
                    ));
                    } else {
                        $msg = "<i>No tiene imagenes.</i>";
                    }

                    if (isset($msg)) {
                        echo $msg;
                    } else {
                        while($img = $extraer_img -> fetch(PDO::FETCH_ASSOC)) { ?>
                            <img src="data:image/png;base64,<?= ($img['file']) ?>">
                        <?php }
                    }
                ?>
            </div>
        </body>
        </html>
    <?php }
?>