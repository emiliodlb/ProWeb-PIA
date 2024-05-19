<?php
session_start();

if (!isset($_SESSION['idUsuario'])) {
    echo "Error: No se ha encontrado el usuario.";
    exit();
}

$IdMesa = $_SESSION['idUsuario']; 

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    header('Location: index_carrito.php');
    exit();
}

include_once 'app/conexion.inc.php';
conexion::abrir_conexion();
$conexion = conexion::obtener_conexion();
$carrito = $_SESSION['carrito'];
$totalOrden = 0;

try {
    // Calcular total 
    foreach ($carrito as $idProducto => $cantidad) {
        $query = $conexion->prepare("SELECT PrecioProducto FROM producto WHERE IdProducto = :idProducto");
        $query->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
        $query->execute();
        $precioProducto = $query->fetchColumn();
        $totalOrden += $precioProducto * $cantidad;
    }

    // Insertar ORDEN
    $IdEstatusOrden = 1; // estatus ACTIVO
    $query = $conexion->prepare("INSERT INTO orden (TotalOrden, FechaOrden, IdMesa, IdEstatusOrden) VALUES (:totalOrden, NOW(), :IdMesa, :IdEstatusOrden)");
    $query->bindParam(':totalOrden', $totalOrden);
    $query->bindParam(':IdMesa', $IdMesa, PDO::PARAM_INT);
    $query->bindParam(':IdEstatusOrden', $IdEstatusOrden, PDO::PARAM_INT);
    $query->execute();

    $IdOrden = $conexion->lastInsertId();

    // Insertar c/producto en detalleorden
    foreach ($carrito as $idProducto => $cantidad) {
        $query = $conexion->prepare("INSERT INTO detalleorden (IdOrden, IdProducto, Cantidad, Precio) VALUES (:IdOrden, :IdProducto, :cantidad, (SELECT PrecioProducto FROM producto WHERE IdProducto = :IdProducto))");
        $query->bindParam(':IdOrden', $IdOrden, PDO::PARAM_INT);
        $query->bindParam(':IdProducto', $idProducto, PDO::PARAM_INT);
        $query->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $query->execute();
    }

    conexion::cerrar_conexion();
    unset($_SESSION['carrito']);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    conexion::cerrar_conexion();
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden Generada - Usuario <?php echo $IdMesa; ?></title>
</head>
<body>
    <h1>Orden Generada</h1>
    <p>Su orden ha sido generada exitosamente.</p>
    <a href="inicio.php">Volver a productos</a>
</body>
</html>
