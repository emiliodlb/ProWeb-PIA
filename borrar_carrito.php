<?php
session_start();

if (isset($_SESSION['usuario'])) {
    try {
        include_once 'app/conexion.inc.php';
        $idUsuario = $_SESSION['usuario']['IdUsuario'];

        conexion::abrir_conexion();
        $conexion = conexion::obtener_conexion();

        //borra productos del carrito del usuario
        $sql = "DELETE FROM carrito WHERE idusuario = :idUsuario";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $sentencia->execute();

        conexion::cerrar_conexion();

        header("Location: inicio.php");
        exit();
    } catch (PDOException $ex) {
        print "ERROR: " . $ex->getMessage() . "<br>";
        die();
    }
} else {
    header('Location: inicio.php');
    exit();
}
?>
