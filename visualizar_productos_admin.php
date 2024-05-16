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
    <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-success mt-3" id="btnAgregarProducto" data-toggle="modal" data-target="#modalAgregarProducto">Agregar Usuario</button>
        <a href="inicio.php" class="btn btn-secondary mt-3">Regresar</a>
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Editar</th>
                <th>Eliminar</th>
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
                echo '<button type="button" class="btn btn-primary btn-editar" data-toggle="modal" data-target="#modalEditarProducto" data-id="' . $producto->getIdProducto() . '">Editar</button>';
                echo '</td>';
                echo '<td>';
                echo '<button type="button" class="btn btn-danger btn-eliminar" data-id="' . $producto->getIdProducto() . '">Eliminar</button>';
                echo '</td>';
                echo '</tr>';
            }

            conexion::cerrar_conexion();
            ?>
        </tbody>
    </table>
</div>

<!--agregar pto -->
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
                <!--formulario agregar pto -->
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

<!-- Modal editar pto -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarProductoLabel">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--formulario editar pto -->
                <form id="formEditarProducto" action="app/actualizar_producto.php" method="post">
                    <input type="hidden" id="idProductoEditar" name="idProducto">
                    <div class="form-group">
                        <label for="nombreProductoEditar">Nombre:</label>
                        <input type="text" class="form-control" id="nombreProductoEditar" name="nombreProductoEditar" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcionProductoEditar">Descripción:</label>
                        <textarea class="form-control" id="descripcionProductoEditar" name="descripcionProductoEditar" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="precioProductoEditar">Precio:</label>
                        <input type="number" class="form-control" id="precioProductoEditar" name="precioProductoEditar" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#modalAgregarProducto').on('show.bs.modal', function () {
            $('#formAgregarProducto')[0].reset();
        });

        //eliminar un producto
        $('.btn-eliminar').click(function() {
            var idProducto = $(this).data('id');
            
            //alerta confirmación
            var confirmacion = confirm("¿Estás seguro de que quieres eliminar este producto?");
            
            //solicitud AJAX
            if (confirmacion) {
                $.ajax({
                    type: 'POST',
                    url: 'app/eliminar_producto.php',
                    data: { idProducto: idProducto },
                    success: function(response) {
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

<script>
    $(document).ready(function() {
        //cargar datos en modal edición
        $('.btn-editar').click(function() {
            var idProducto = $(this).data('id');
            
            //solicitud AJAX para obtener datos del pto
            $.ajax({
                type: 'POST',
                url: 'app/obtener_producto.php',
                data: { idProducto: idProducto },
                dataType: 'json',
                success: function(data) {
                    // llenado de campos con info del pto
                    $('#idProductoEditar').val(data.idProducto);
                    $('#nombreProductoEditar').val(data.nombreProducto);
                    $('#descripcionProductoEditar').val(data.descripcionProducto);
                    $('#precioProductoEditar').val(data.precioProducto);
                    
                    // muestra modal de editar pto
                    $('#modalEditarProducto').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


</body>
</html>
