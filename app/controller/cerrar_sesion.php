<?php
session_start();
session_destroy();

echo json_encode([1,'Sesion Cerrada'])

?>
