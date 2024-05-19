<?php
include_once 'app/conexion.inc.php';
include_once 'funciones_carrito.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];

// ELIMINACION EN DB
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $idUsuario = $usuario['IdUsuario'];
    $idProducto = $_POST['idProducto'];
    $accion = $_POST['accion'];

    try {
        conexion::abrir_conexion();
        $conexion = conexion::obtener_conexion();

        if ($accion == 'eliminar_todo') {
            $sql = "DELETE FROM carrito WHERE idusuario = :idUsuario AND idproducto = :idProducto";
        } else if ($accion == 'eliminar_unidad') {
            $sql = "UPDATE carrito SET Cantidad = Cantidad - 1 WHERE idusuario = :idUsuario AND idproducto = :idProducto";
        }

        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
        $sentencia->execute();

        if ($accion == 'eliminar_unidad' && $sentencia->rowCount() > 0) {
            $sql = "DELETE FROM carrito WHERE idusuario = :idUsuario AND idproducto = :idProducto AND Cantidad = 0";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            $sentencia->execute();
        }

        conexion::cerrar_conexion();
        header("Location: carrito.php");
        exit();
    } catch (PDOException $ex) {
        print "ERROR: " . $ex->getMessage() . "<br>";
        die();
    }
}

// cONFIRMAR
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {
    try {
        conexion::abrir_conexion();
        $conexion = conexion::obtener_conexion();

        //crear orden con los productos del carrito
        $productos = funciones_carrito::obtener_productos_carrito($usuario['IdUsuario']);
        $totalOrden = 0;

        //calcular total
        foreach ($productos as $producto) {
            $totalOrden += $producto['Total'];
        }
        date_default_timezone_set('America/Mexico_City');
        //insertar orden en DB
        $fechaOrden = date('Y-m-d H:i:s');
        $idMesa = $usuario['IdUsuario'];
        $idEstatusOrden = 1; 
        $sql = "INSERT INTO orden (TotalOrden, FechaOrden, IdMesa, IdEstatusOrden) VALUES (:totalOrden, :fechaOrden, :idMesa, :idEstatusOrden)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':totalOrden', $totalOrden, PDO::PARAM_STR);
        $sentencia->bindParam(':fechaOrden', $fechaOrden, PDO::PARAM_STR);
        $sentencia->bindParam(':idMesa', $idMesa, PDO::PARAM_INT);
        $sentencia->bindParam(':idEstatusOrden', $idEstatusOrden, PDO::PARAM_INT);
        $sentencia->execute();

        $idOrden = $conexion->lastInsertId();

        // Insertar detalle
        foreach ($productos as $producto) {
            $idProducto = $producto['IdProducto'];
            $cantidad = $producto['Cantidad'];
            $precio = $producto['PrecioProducto'];
            $sql = "INSERT INTO detalleorden (IdOrden, IdProducto, Cantidad, Precio) VALUES (:idOrden, :idProducto, :cantidad, :precio)";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(':idOrden', $idOrden, PDO::PARAM_INT);
            $sentencia->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            $sentencia->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $sentencia->bindParam(':precio', $precio, PDO::PARAM_STR);
            $sentencia->execute();
        }

        // Eliminar todos los productos del carrito
        $sql = "DELETE FROM carrito WHERE idusuario = :idUsuario";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $sentencia->execute();

        conexion::cerrar_conexion();
        header("Location: orden_creada.php?idOrden=$idOrden");
        exit();
    } catch (PDOException $ex) {
        print "ERROR: " . $ex->getMessage() . "<br>";
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style></style>
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">Usuario, <?php echo $usuario['NombreUsuario']; ?>!</h3>
        <h1 class="mb-4">Carrito</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Total</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Obtener productos del carrito del usuario
                $productos = funciones_carrito::obtener_productos_carrito($usuario['IdUsuario']);

                $totalCarrito = 0;

                // Mostrar productos
                foreach ($productos as $producto) {
                    echo "<tr>";
                    echo "<td>{$producto['NombreProducto']}</td>";
                    echo "<td>{$producto['PrecioProducto']}</td>";
                    echo "<td>{$producto['Cantidad']}</td>";
                    echo "<td>{$producto['Total']}</td>";
                    //incrementar total de carrito
                    $totalCarrito += $producto['Total'];
                    echo "<td>
                            <form method='post' action='' style='display:inline-block;'>
                                <input type='hidden' name='idProducto' value='{$producto['IdProducto']}'>
                                <input type='hidden' name='accion' value='eliminar_todo'>
                                <button type='submit' class='btn btn-danger btn-sm'>Eliminar Todo</button>
                            </form>
                            <form method='post' action='' style='display:inline-block;'>
                                <input type='hidden' name='idProducto' value='{$producto['IdProducto']}'>
                                <input type='hidden' name='accion' value='eliminar_unidad'>
                                <button type='submit' class='btn btn-warning btn-sm'>Eliminar Unidad</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="text-right">
            <?php if (!empty($productos)) : ?>
                <!-- Mostrar el total del carrito -->
                <h5>Total: $<?php echo number_format($totalCarrito, 2); ?></h5>
                <!-- Formulario para confirmar la orden -->
                <form method="post" action="">
                    <button  type="submit" name="confirmar" class="btn btn-primary">Confirmar</button>
                </form>
            <?php endif; ?>
            <a href="menu_productos.php" class="btn btn-secondary">Seguir Añadiendo</a>
        </div>
    </div>


</body>
</html>

