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
    
    <!-- Barra de filtrado -->
    <form class="form-inline mt-3 mb-3" method="get" action="">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Buscar" aria-label="Buscar">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
    
    <a href="inicio.php" class="btn btn-secondary mt-3">Regresar</a>
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

            $search = isset($_GET['search']) ? $_GET['search'] : '';

            $query = "SELECT * FROM producto WHERE IdProducto LIKE :search OR NombreProducto LIKE :search";
            $stmt = conexion::obtener_conexion()->prepare($query);
            $likeSearch = "%" . $search . "%";
            $stmt->bindParam(':search', $likeSearch, PDO::PARAM_STR);
            $stmt->execute();

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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

