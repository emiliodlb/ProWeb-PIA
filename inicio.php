<?php
session_start();

if (!isset($_SESSION['usuario'])) {

    header('Location: login.php');
    exit();
}

$usuario = $_SESSION['usuario'];

echo "¡Bienvenido, {$usuario['NombreUsuario']}! Has iniciado sesión correctamente.";
?>
