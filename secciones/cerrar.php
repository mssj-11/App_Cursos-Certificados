<?php
// Cerrando la conexion
session_start();
session_destroy();
header('Location: ../index.php');
?>