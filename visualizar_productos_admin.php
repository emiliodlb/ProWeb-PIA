<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Registrados</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>

<div class="container mt-5">
    <h2>Productos Registrados</h2>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody id="tabla-productos">
            <?php
            include_once 'app/conexion.inc.php';
            include_once 'app/producto.inc.php';
            conexion::abrir_conexion();

            $query = "SELECT * FROM producto";
            $stmt = conexion::obtener_conexion()->query($query);

            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $producto = new Producto($fila['IdProducto'], $fila['NombreProducto'], $fila['DescripcionProducto'], $fila['PrecioProducto']);
                echo '<tr>';
                echo '<td>' . $producto->getIdProducto() . '</td>';
                echo '<td>' . $producto->getNombreProducto() . '</td>';
                echo '<td>' . $producto->getDescripcionProducto() . '</td>';
                echo '<td>' . $producto->getPrecioProducto() . '</td>';
                echo '</tr>';
            }

            conexion::cerrar_conexion();
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
