<?php
include_once 'app/conexion.inc.php';

if (!isset($_GET['idOrden'])) {
    header('Location: inicio.php'); 
    exit();
}

$idOrden = $_GET['idOrden'];

try {
    conexion::abrir_conexion();
    $conexion = conexion::obtener_conexion();

    //Obtener detalles de orden
    $sql = "SELECT o.*, u.NombreUsuario, e.NombreEstatus
            FROM orden o
            INNER JOIN usuario u ON o.IdMesa = u.IdUsuario
            INNER JOIN estatusorden e ON o.IdEstatusOrden = e.IdEstatusOrden
            WHERE o.IdOrden = :idOrden";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam(':idOrden', $idOrden, PDO::PARAM_INT);
    $sentencia->execute();
    $orden = $sentencia->fetch(PDO::FETCH_ASSOC);

    //Obtener productos de orden
    $sql = "SELECT p.NombreProducto, do.Cantidad, do.Precio
            FROM detalleorden do
            INNER JOIN producto p ON do.IdProducto = p.IdProducto
            WHERE do.IdOrden = :idOrden";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam(':idOrden', $idOrden, PDO::PARAM_INT);
    $sentencia->execute();
    $productos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    conexion::cerrar_conexion();
} catch (PDOException $ex) {
    print "ERROR: " . $ex->getMessage() . "<br>";
    die();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Orden</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/orden_creada.css">
</head>
<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1 class="mb-4">Detalles de la Orden</h1>
            <h4 class="mb-2">Orden ID: <?php echo $orden['IdOrden']; ?></h4>
            <p class="mb-2">Realizada por: <?php echo $orden['NombreUsuario']; ?></p>
            <p class="mb-2">Fecha de la Orden: <?php echo $orden['FechaOrden']; ?></p>
            <p class="mb-2">Estatus: <?php echo $orden['NombreEstatus']; ?></p>
        </div>
        
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto['NombreProducto']; ?></td>
                            <td><?php echo $producto['Cantidad']; ?></td>
                            <td>$<?php echo number_format($producto['Precio'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-right mt-4">
            <h4>Total de la Orden: $<?php echo number_format($orden['TotalOrden'], 2); ?></h4>
            <!--forms para enviar -->
            <form id="formBorrarCarrito" action="borrar_carrito.php" method="post">
                <button type="submit" class="btn btn-success">Volver al Inicio</button>
            </form>
        </div>
    </div>
</body>
</html>
