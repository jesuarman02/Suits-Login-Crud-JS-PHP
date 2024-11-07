<?php
require_once("./app/config/dependencias.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS . "bootstrap.min.css"; ?>">
    <link rel="stylesheet" href="<?= CSS . "inicio.css"; ?>">
    <link rel="stylesheet" href="<?= ICONS . "dt.css"; ?>">
    <link rel="stylesheet" href="<?= ICONS . "bootstrap-icons.css"; ?>">
    <link rel="stylesheet" href="./public/css/dt.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./public/js/dt.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <title>Formulario de datos</title>
</head>

<body>

    <?php

        if (isset($_REQUEST['view'])) {
            $vista = $_REQUEST['view'];
        }else{
            $vista = "incio";
        }
        switch ($vista) {
            case "inicio":{
                require_once './views/home.php';
                break;
            }
            case "login":{
                require_once './views/login.php';
                break;
            }
            case "registro":{
                require_once './views/registro.php';
                break;
            }
            case "cerrar_sesion":{
                require_once './app/controller/cerrar_sesion.php';
                break;
            }
            default:{
                require_once './views/error404.php';
                break;
            }
        }
    ?>



</body>

</html>