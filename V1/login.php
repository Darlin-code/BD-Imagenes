<?php
    session_start();
    require_once("pdo.php");

    if (isset($_POST["cancel"])) {
        header("Location: index.php");
        return;
    }

    if (isset($_POST["email"]) && isset($_POST["pw"])) {
        if (empty($_POST["email"]) || empty($_POST["pw"])) {
            $_SESSION["msg"] = "<p style='color: red'>Rellene todos los campos.</p>";
            header("Location: login.php");
            return;
        } else {
            $query = "SELECT COUNT(*) conteo FROM `users` WHERE email_user = :em AND pw_user = :pw;";
            $query_conteo = $pdo -> prepare($query);
            $query_conteo -> execute(Array(
                ':em' => htmlentities($_POST["email"]),
                ':pw' => hash("md5", $_POST["pw"])
            ));
            $conteo = $query_conteo -> fetch(PDO::FETCH_ASSOC);

            if ($conteo["conteo"] !== 0) {
                $query = "SELECT * FROM `users` WHERE email_user = :em AND pw_user = :pw;";
                $query_user = $pdo -> prepare($query);
                $query_user -> execute(Array(
                ':em' => htmlentities($_POST["email"]),
                ':pw' => hash("md5", $_POST["pw"])
            ));
            $user_data = $query_user -> fetch(PDO::FETCH_ASSOC);

            $_SESSION["USER_AUTH"] = hash("md5", $user_data["email_user"] . $user_data["pw_user"]);
            $_SESSION["USER_AUTH_EMAIL"] = $user_data["email_user"];
            $_SESSION["USER_AUTH_UID"] = $user_data["user_id"];

            header("Location: index.php");
            return;

            } else {
                $_SESSION["msg"] = "<p style='color: red'>Correo o contraseña incorrectos.</p>";
                header("Location: login.php");
                return;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicie sesión</title>
</head>
<body>
    <h1 style="margin: 0;">Inicie sesión para continuar.</h1>
    <span style="font-size: 10px; margin-top: 0px;"><i>No tienes cuenta? Sal de la página: </i><a href="https://www.google.com">Salir</a></span>
    <form action="" method="post" style="margin-top: 20px;">
        <?php
            if (isset($_SESSION["msg"])) {
                echo $_SESSION["msg"];
                unset($_SESSION["msg"]);
            }
        ?>
        <label for="email">
            Correo: <input type="text" name="email" id="email">
        </label><br>
        <label for="pw">
            Contraseña: <input type="text" name="pw" id="pw">
        </label><br><br>
        <button type="submit" name="cancel">Cancelar</button>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>