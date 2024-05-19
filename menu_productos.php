<?php
include_once 'app/conexion.inc.php';

conexion::abrir_conexion();

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
        <div class="row">
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
        <!-- Botón para ir al carrito -->
        <div class="text-center mt-4">
            <a href="#" class="btn btn-secondary">Ir al carrito</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="hscripts/bootstrap.min.js"></script>
</body>
</html>
