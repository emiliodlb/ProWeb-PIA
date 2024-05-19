<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];

include_once 'app/conexion.inc.php';

conexion::abrir_conexion();

// agregado de productos en db
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idproducto']) && isset($_POST['cantidad'])) {
    $idProducto = $_POST['idproducto'];
    $cantidad = $_POST['cantidad'];

    $sql = "SELECT * FROM carrito WHERE idusuario = :idusuario AND idproducto = :idproducto";
    $stmt = conexion::obtener_conexion()->prepare($sql);
    $stmt->bindParam(':idusuario', $usuario['IdUsuario']);
    $stmt->bindParam(':idproducto', $idProducto);
    $stmt->execute();
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
        $sql = "UPDATE carrito SET cantidad = cantidad + :cantidad WHERE idusuario = :idusuario AND idproducto = :idproducto";
        $stmt = conexion::obtener_conexion()->prepare($sql);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':idusuario', $usuario['IdUsuario']);
        $stmt->bindParam(':idproducto', $idProducto);
        $stmt->execute();
    } else {
        $sql = "INSERT INTO carrito (idusuario, idproducto, cantidad) VALUES (:idusuario, :idproducto, :cantidad)";
        $stmt = conexion::obtener_conexion()->prepare($sql);
        $stmt->bindParam(':idusuario', $usuario['IdUsuario']);
        $stmt->bindParam(':idproducto', $idProducto);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->execute();
    }
}

if (isset($_SESSION['eliminar_carrito']) && $_SESSION['eliminar_carrito'] === true) {
    $sql = "DELETE FROM carrito WHERE idusuario = :idusuario";
    $stmt = conexion::obtener_conexion()->prepare($sql);
    $stmt->bindParam(':idusuario', $usuario['IdUsuario']);
    $stmt->execute();
    unset($_SESSION['eliminar_carrito']);
}

// Obtiene los productos de la DB
$sql = "SELECT * FROM producto";
$resultado = conexion::obtener_conexion()->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Catálogo de Productos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <style>
        .producto {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Catálogo de Productos</h1>
        <h3 class="text-center">Usuario, <?php echo $usuario['NombreUsuario']; ?>!</h3>
        <div class="d-flex justify-content-between">
        <a href="inicio.php" class="btn btn-secondary mt-3">Regresar</a>
    </div>
        <div class="row">
            <!-- productos -->
            <?php
            if ($resultado->rowCount() > 0) {
                // Mostrar los productos
                while($producto = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col-md-4 producto">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $producto['NombreProducto']; ?></h5>
                                <p class="card-text"><?php echo $producto['DescripcionProducto']; ?></p>
                                <p class="card-text">Precio: <?php echo $producto['PrecioProducto']; ?></p>
                                <!-- forms agregar al carrito -->
                                <form action="#" method="post">
                                    <input type="hidden" name="idproducto" value="<?php echo $producto['IdProducto']; ?>">
                                    <input type="number" name="cantidad" value="1" min="1" max="99" class="form-control mb-2">
                                    <button type="submit" class="btn btn-primary btn-block">Agregar al carrito</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-md-12'>No se encontraron productos.</div>";
            }
            ?>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <a href="carrito.php" class="btn btn-primary">Ver Carrito</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>
