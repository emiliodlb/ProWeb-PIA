<?php
session_start();

include_once 'app/conexion.inc.php';
conexion::abrir_conexion();
$conexion = conexion::obtener_conexion();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$idUsuario = $_SESSION['usuario']['IdUsuario'];

//agregar productos al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (isset($_SESSION['carrito'][$idProducto])) {
        $_SESSION['carrito'][$idProducto] += $cantidad;
    } else {
        $_SESSION['carrito'][$idProducto] = $cantidad;
    }

    $_SESSION['idUsuario'] = $idUsuario;

    header('Location: carrito.php');
    exit();
}

//obtener productos del carrito
$carrito = $_SESSION['carrito'] ?? [];

$productos = [];
foreach ($carrito as $idProducto => $cantidad) {
    $query = $conexion->prepare("SELECT * FROM producto WHERE IdProducto = :idProducto");
    $query->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
    $query->execute();
    $producto = $query->fetch();
    $producto['cantidad'] = $cantidad;
    $productos[] = $producto;
}

conexion::cerrar_conexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <ul>
        <?php foreach ($productos as $producto) { ?>
            <li>
                <?php echo $producto['NombreProducto']; ?> - <?php echo $producto['PrecioProducto']; ?>€ - Cantidad: <?php echo $producto['cantidad']; ?>
            </li>
        <?php } ?>
    </ul>
    <form action="orden.php" method="POST">
        <button type="submit">Generar Orden</button>
    </form>
    <a href="index_carrito.php">Seguir comprando</a>
</body>
</html>
