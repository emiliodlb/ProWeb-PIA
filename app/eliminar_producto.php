<?php
if (isset($_POST['idProducto'])) {
    include_once 'conexion.inc.php';

    $idProducto = $_POST['idProducto'];

    conexion::abrir_conexion();

    try {
        //consulta SQL
        $query = "DELETE FROM producto WHERE IdProducto = ?";
        $stmt = conexion::obtener_conexion()->prepare($query);
        $stmt->bindParam(1, $idProducto);

        //Ejecutar consulta
        if ($stmt->execute()) {
            //eliminación exitosa
            echo "Producto eliminado correctamente";
        } else {
            //Error
            echo "Error al eliminar el producto";
        }
    } catch (PDOException $ex) {
        echo "Error en la conexión: " . $ex->getMessage();
    }
    conexion::cerrar_conexion();
} else {
    echo "ID de producto no válido";
}
?>
