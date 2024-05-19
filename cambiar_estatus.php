<?php
include_once 'app/conexion.inc.php';
if (!isset($_POST['idOrden']) || !isset($_POST['nuevoEstatus'])) {
    header('Location: ordenes.php');
    exit();
}

$idOrden = $_POST['idOrden'];
$nuevoEstatus = $_POST['nuevoEstatus'];

try {
    conexion::abrir_conexion();
    $conexion = conexion::obtener_conexion();

    // Actualizar estatus
    $sql = "UPDATE orden SET IdEstatusOrden = :nuevoEstatus WHERE IdOrden = :idOrden";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam(':nuevoEstatus', $nuevoEstatus, PDO::PARAM_INT);
    $sentencia->bindParam(':idOrden', $idOrden, PDO::PARAM_INT);
    $sentencia->execute();

    conexion::cerrar_conexion();

    header('Location: modificar_estatus.php');
    exit();
} catch (PDOException $ex) {
    print "ERROR: " . $ex->getMessage() . "<br>";
    die();
}
?>
