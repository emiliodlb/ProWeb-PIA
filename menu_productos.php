<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];

include_once 'app/conexion.inc.php';

conexion::abrir_conexion();

// Procesar forms
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

// Obtener búsqueda
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Obtener los productos de la DB
$sql = "SELECT * FROM producto WHERE NombreProducto LIKE :search";
$stmt = conexion::obtener_conexion()->prepare($sql);
$likeSearch = "%" . $search . "%";
$stmt->bindParam(':search', $likeSearch, PDO::PARAM_STR);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

conexion::cerrar_conexion();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Catálogo de Productos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <style>.producto {margin-bottom: 20px;}</style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Menu Disponible</h1>
        
        <div class="d-flex justify-content-between mb-6">
            <div class="form-inline">
                <form class="form-inline" method="get" action="">
                    <input class="form-control mr-3" type="search" name="search" placeholder="Buscar" aria-label="Buscar" value="<?php echo htmlspecialchars($search); ?>">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
            </div>
            <div>
                <a href="inicio.php" class="btn btn-outline-primary">Regresar a Inicio</a>

            </div>
        </div>
        
        <br>
        <div class="row">
        <a href="carrito.php" class="btn btn-primary">Ver Carrito</a>
        </div>
        <br>
        <div class="row">
            
            <!-- productos -->
            <?php
            if (count($resultado) > 0) {
                // Mostrar los productos
                foreach ($resultado as $producto) {
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
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>
