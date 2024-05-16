<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idProducto']) && isset($_POST['nombreProductoEditar']) && isset($_POST['descripcionProductoEditar']) && isset($_POST['precioProductoEditar'])) {
        include_once 'conexion.inc.php';
        
        $idProducto = $_POST['idProducto'];
        $nombreProducto = $_POST['nombreProductoEditar'];
        $descripcionProducto = $_POST['descripcionProductoEditar'];
        $precioProducto = $_POST['precioProductoEditar'];
        
        try {
            conexion::abrir_conexion();
            
            $query = "UPDATE producto SET NombreProducto = :nombre, DescripcionProducto = :descripcion, PrecioProducto = :precio WHERE IdProducto = :id";
            $stmt = conexion::obtener_conexion()->prepare($query);
            
            $stmt->bindParam(':nombre', $nombreProducto);
            $stmt->bindParam(':descripcion', $descripcionProducto);
            $stmt->bindParam(':precio', $precioProducto);
            $stmt->bindParam(':id', $idProducto);
            
            $stmt->execute();
            
            conexion::cerrar_conexion();
            
            header("Location: ../visualizar_productos_admin.php");
            exit();
        } catch (PDOException $ex) {
            echo "Error al actualizar el producto: " . $ex->getMessage();
        }
    } else {
        header("Location: ../visualizar_productos_admin.php");
        exit();
    }
} else {
    header("Location: ../visualizar_productos_admin.php");
    exit();
}
?>
