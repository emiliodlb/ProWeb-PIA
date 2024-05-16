<?php
if (isset($_POST['idProducto'])) {
    include_once 'conexion.inc.php';
    include_once 'producto.inc.php';
    
    $idProducto = $_POST['idProducto'];
    
    try {
        conexion::abrir_conexion();
        
        $query = "SELECT * FROM producto WHERE IdProducto = :idProducto";
        $stmt = conexion::obtener_conexion()->prepare($query);
        $stmt->bindParam(':idProducto', $idProducto);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $producto = new Producto($fila['IdProducto'], $fila['NombreProducto'], $fila['DescripcionProducto'], $fila['PrecioProducto']);
    
        conexion::cerrar_conexion();
        
        echo json_encode(array(
            'idProducto' => $producto->getIdProducto(),
            'nombreProducto' => $producto->getNombreProducto(),
            'descripcionProducto' => $producto->getDescripcionProducto(),
            'precioProducto' => $producto->getPrecioProducto()
        ));
    } catch (PDOException $ex) {
        echo "Error al obtener el producto: " . $ex->getMessage();
    }
} else {
}
?>
