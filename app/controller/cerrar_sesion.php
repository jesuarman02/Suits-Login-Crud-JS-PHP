<?php
session_start();
session_unset();
session_destroy();

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    echo json_encode(['success' => true, 'message' => 'Sesión cerrada con éxito.']);
} else {
    header("Location: ../../login.php");
    exit();
}
?>