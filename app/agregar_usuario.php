<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once 'conexion.inc.php';
    
    $nombreUsuario = $_POST['nombreUsuario'];
    $telefonoUsuario = $_POST['telefonoUsuario'];
    $lugarMesa = $_POST['lugarMesa'];
    $espacioMesa = $_POST['espacioMesa'];
    $rolUsuario = $_POST['rolUsuario'];
    $passwordUsuario = $_POST['passwordUsuario'];
    
    conexion::abrir_conexion();
    $query = "INSERT INTO usuario (NombreUsuario, TelefonoUsuario, LugarMesa, EspacioMesa, IdRol, PasswordUsuario) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = conexion::obtener_conexion()->prepare($query);
    $stmt->bindParam(1, $nombreUsuario);
    $stmt->bindParam(2, $telefonoUsuario);
    $stmt->bindParam(3, $lugarMesa);
    $stmt->bindParam(4, $espacioMesa);
    $stmt->bindParam(5, $rolUsuario);
    $stmt->bindParam(6, $passwordUsuario);
    
    if ($stmt->execute()) {
        header("Location: ../visualizar_empleados_admin.php");
        exit();
    } else {
        echo "Error al agregar usuario.";
    }
    
    conexion::cerrar_conexion();
} else {
    echo "Error: Los datos del formulario no fueron recibidos correctamente.";
}
?>
