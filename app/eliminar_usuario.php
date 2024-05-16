<?php
include_once 'conexion.inc.php';

if (isset($_POST['idUsuario'])) {
    $idUsuario = $_POST['idUsuario'];

    conexion::abrir_conexion();
    $query = "DELETE FROM usuario WHERE IdUsuario = :id";
    $stmt = conexion::obtener_conexion()->prepare($query);
    $stmt->bindParam(':id', $idUsuario);
    $stmt->execute();
    conexion::cerrar_conexion();

    echo "Usuario eliminado correctamente";
} else {
    echo "Error: No se proporcionó un ID de usuario válido";
}
?>
