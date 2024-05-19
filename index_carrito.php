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

// qUERY para obtener los productos
$query = $conexion->prepare("SELECT * FROM producto");
$query->execute();
$productos = $query->fetchAll();

conexion::cerrar_conexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos - Usuario <?php echo $idUsuario; ?></title>
</head>
<body>
    <h1>Productos - Usuario <?php echo $idUsuario; ?></h1>
    <ul>
        <?php foreach ($productos as $producto) { ?>
            <li>
                <form action="carrito.php" method="POST">
                    <?php echo $producto['NombreProducto']; ?> - <?php echo $producto['PrecioProducto']; ?>€
                    <input type="hidden" name="idProducto" value="<?php echo $producto['IdProducto']; ?>">
                    <input type="number" name="cantidad" min="1" value="1">
                    <button type="submit">Agregar al carrito</button>
                </form>
            </li>
        <?php } ?>
    </ul>
</body>
</html>
