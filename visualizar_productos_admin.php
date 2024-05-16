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
    <div class="row mb-3">
        <div class="col">
            <h2>Productos Registrados</h2>
        </div>
        <div class="col text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAgregarProducto">Agregar Producto</button>
        </div>
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th> <!-- Nueva columna para acciones -->
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
                echo '<td>';
                // Botón para eliminar producto
                echo '<button type="button" class="btn btn-danger btn-eliminar" data-id="' . $producto->getIdProducto() . '">Eliminar</button>';
                echo '</td>';
                echo '</tr>';
            }

            conexion::cerrar_conexion();
            ?>
        </tbody>
    </table>
</div>

<!-- Modal para agregar producto -->
<div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProductoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarProductoLabel">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aquí va el formulario para agregar producto -->
                <form id="formAgregarProducto" action="app/agregar_producto.php" method="post">
                    <div class="form-group">
                        <label for="nombreProducto">Nombre:</label>
                        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcionProducto">Descripción:</label>
                        <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="precioProducto">Precio:</label>
                        <input type="number" class="form-control" id="precioProducto" name="precioProducto" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#modalAgregarProducto').on('show.bs.modal', function () {
            $('#formAgregarProducto')[0].reset();
        });

        // Evento para eliminar un producto
        $('.btn-eliminar').click(function() {
            // Obtener el ID del producto a eliminar
            var idProducto = $(this).data('id');
            
            // Mostrar una alerta de confirmación
            var confirmacion = confirm("¿Estás seguro de que quieres eliminar este producto?");
            
            // Si el usuario confirma la eliminación, realizar la solicitud AJAX
            if (confirmacion) {
                $.ajax({
                    type: 'POST',
                    url: 'app/eliminar_producto.php',
                    data: { idProducto: idProducto },
                    success: function(response) {
                        // Recargar la página para actualizar la lista de productos
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>

</body>
</html>
