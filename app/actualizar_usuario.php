<?php
include_once 'conexion.inc.php';

$idUsuario = $_POST['idUsuario'];
$nombreUsuario = $_POST['nombreUsuario'];
$telefonoUsuario = $_POST['telefonoUsuario'];
$lugarMesa = $_POST['lugarMesa'];
$espacioMesa = $_POST['espacioMesa'];
$rolUsuario = $_POST['rolUsuario'];
$passwordUsuario = $_POST['passwordUsuario'];

conexion::abrir_conexion();
$query = "UPDATE usuario SET NombreUsuario = :nombre, TelefonoUsuario = :telefono, LugarMesa = :lugar, EspacioMesa = :espacio, IdRol = :rol, PasswordUsuario = :password WHERE IdUsuario = :id";
$stmt = conexion::obtener_conexion()->prepare($query);
$stmt->bindParam(':nombre', $nombreUsuario);
$stmt->bindParam(':telefono', $telefonoUsuario);
$stmt->bindParam(':lugar', $lugarMesa);
$stmt->bindParam(':espacio', $espacioMesa);
$stmt->bindParam(':rol', $rolUsuario);
$stmt->bindParam(':password', $passwordUsuario);
$stmt->bindParam(':id', $idUsuario);
$stmt->execute();
conexion::cerrar_conexion();

header('Location: ../visualizar_empleados_admin.php');
exit();
?>
