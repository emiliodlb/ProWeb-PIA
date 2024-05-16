<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once 'conexion.inc.php';
    
    $nombreProducto = $_POST['nombreProducto'];
    $descripcionProducto = $_POST['descripcionProducto'];
    $precioProducto = $_POST['precioProducto'];
    
    conexion::abrir_conexion();
    $query = "INSERT INTO producto (NombreProducto, DescripcionProducto, PrecioProducto) VALUES (?, ?, ?)";
    $stmt = conexion::obtener_conexion()->prepare($query);
    $stmt->bindParam(1, $nombreProducto);
    $stmt->bindParam(2, $descripcionProducto);
    $stmt->bindParam(3, $precioProducto);
    
    if ($stmt->execute()) {
        header("Location: ../visualizar_productos_admin.php");
        exit();
    } else {
        echo "Error al agregar producto.";
    }
    
    conexion::cerrar_conexion();
} else {
    echo "Error: Los datos del formulario no fueron recibidos correctamente.";
}
?>
