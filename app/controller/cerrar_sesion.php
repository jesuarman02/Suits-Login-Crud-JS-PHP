<?php
session_start();
session_destroy();

// Redirigir al login después de cerrar sesión
header("Location: ../../login.php"); // Asegúrate de que la ruta sea correcta
exit;
?>
