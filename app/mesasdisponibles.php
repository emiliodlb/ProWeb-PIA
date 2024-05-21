<?php
include_once 'conexion.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idusuario = $_POST['idusuario'];
    $disponibilidad = $_POST['disponibilidad'];

    conexion::abrir_conexion();
    $conexion = conexion::obtener_conexion();

    $sql = 'UPDATE usuario SET DisponibilidadMesa = :disponibilidad WHERE IdUsuario = :idusuario';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam(':disponibilidad', $disponibilidad, PDO::PARAM_INT);
    $sentencia->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
    $sentencia->execute();

    conexion::cerrar_conexion();
}

header('Location: ../mesas.php');
exit();
?>
