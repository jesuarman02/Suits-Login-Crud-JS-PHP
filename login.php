<?php 
require_once "./app/config/dependencias.php";

session_start();
if (isset($_SESSION['usuario'])) {
    header("location: ./index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS."bootstrap.min.css";?>">
    <link rel="stylesheet" href="<?=ICONS."bootstrap-icons.css";?>">
    <link rel="stylesheet" href="<?=CSS."main.css";?>">
    <title>Inicio de sesión</title>
</head>
<body class="d-flex justify-content-center align-items-center mt-5 p-3">
    <form action="./login.php" method="post" class="w-50 p-5">
        <div class="text-center mb-5 c-user">
            <i class="bi bi-person-circle fs-1 text-highlight"></i>
            <div class="text-highlight fs-4">Iniciar Sesión</div>
        </div>
        <div class="input-group mt-3">
            <i class="bi bi-person-fill input-group-text fs-2"></i>
            <input type="email" id="email-id" class="form-control fs-4" placeholder="Ingrese su email" name="email">
        </div>
        <div class="input-group mt-3">
            <i class="bi bi-lock-fill input-group-text fs-2"></i>
            <input type="password" id="pass-id" class="form-control fs-4" placeholder="Ingrese su contraseña" name="pass">
        </div>
        <div class="mt-5 c-button">
             <button type="button" id="btn-saludar" class="btn w-100 fs-4">Ingresar</button>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <p class="text-white">¿No tienes una cuenta?</p> 
            <a href="./registro_vista.php" class="text-primary mx-3">Crear ahora</a>
        </div>
    </form>

    <script src="./public/js/alerts.js"></script>
    <script src="./public/js/main.js"></script>
</body>
</html>
