<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>

<div class="container mt-5">
    <h2>Usuarios Registrados</h2>
    <button type="button" class="btn btn-success mt-3" id="btnAgregarUsuario" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar Usuario</button>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Lugar Mesa</th>
                <th>Espacio Mesa</th>
                <th>Rol</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody id="tabla-usuarios">
            <?php
            include_once 'app/conexion.inc.php';
            conexion::abrir_conexion();

            $query = "SELECT * FROM usuario";
            $stmt = conexion::obtener_conexion()->query($query);

            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $fila['IdUsuario'] . '</td>';
                echo '<td>' . $fila['NombreUsuario'] . '</td>';
                echo '<td>' . $fila['TelefonoUsuario'] . '</td>';
                echo '<td>' . $fila['LugarMesa'] . '</td>';
                echo '<td>' . $fila['EspacioMesa'] . '</td>';
                echo '<td>' . $fila['IdRol'] . '</td>';
                echo '<td><button type="button" class="btn btn-primary btn-editar" data-id="' . $fila['IdUsuario'] . '" data-nombre="' . $fila['NombreUsuario'] . '" data-telefono="' . $fila['TelefonoUsuario'] . '" data-lugar="' . $fila['LugarMesa'] . '" data-espacio="' . $fila['EspacioMesa'] . '" data-rol="' . $fila['IdRol'] . '" data-password="' . $fila['PasswordUsuario'] . '">Modificar</button></td>';
                echo '<td><button type="button" class="btn btn-danger btn-eliminar" data-id="' . $fila['IdUsuario'] . '">Eliminar</button></td>';
                echo '</tr>';
            }

            conexion::cerrar_conexion();
            ?>
        </tbody>
    </table>
</div>


<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditarUsuario" action="app/actualizar_usuario.php" method="post">
          <div class="form-group">
            <label for="nombreUsuario">Nombre:</label>
            <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" required>
          </div>
          <div class="form-group">
            <label for="telefonoUsuario">Teléfono:</label>
            <input type="text" class="form-control" id="telefonoUsuario" name="telefonoUsuario">
          </div>
          <div class="form-group">
            <label for="lugarMesa">Lugar Mesa:</label>
            <input type="text" class="form-control" id="lugarMesa" name="lugarMesa">
          </div>
          <div class="form-group">
            <label for="espacioMesa">Espacio Mesa:</label>
            <input type="text" class="form-control" id="espacioMesa" name="espacioMesa">
          </div>
          <div class="form-group">
            <label for="rolUsuario">Rol:</label>
            <input type="text" class="form-control" id="rolUsuario" name="rolUsuario" required>
          </div>
          <div class="form-group">
            <label for="passwordUsuario">Contraseña:</label>
            <input type="password" class="form-control" id="passwordUsuario" name="passwordUsuario" required>
          </div>
          <input type="hidden" id="idUsuario" name="idUsuario">
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalAgregarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAgregarUsuarioLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAgregarUsuario" action="app/agregar_usuario.php" method="post">
          <div class="form-group">
            <label for="nombreUsuario">Nombre:</label>
            <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" required>
          </div>
          <div class="form-group">
            <label for="telefonoUsuario">Teléfono:</label>
            <input type="text" class="form-control" id="telefonoUsuario" name="telefonoUsuario">
          </div>
          <div class="form-group">
            <label for="lugarMesa">Lugar Mesa:</label>
            <input type="text" class="form-control" id="lugarMesa" name="lugarMesa">
          </div>
          <div class="form-group">
            <label for="espacioMesa">Espacio Mesa:</label>
            <input type="text" class="form-control" id="espacioMesa" name="espacioMesa">
          </div>
          <div class="form-group">
            <label for="rolUsuario">Rol:</label>
            <input type="text" class="form-control" id="rolUsuario" name="rolUsuario" required>
          </div>
          <div class="form-group">
            <label for="passwordUsuario">Contraseña:</label>
            <input type="password" class="form-control" id="passwordUsuario" name="passwordUsuario" required>
          </div>
          <button type="submit" class="btn btn-primary">Agregar Usuario</button>
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

        // Función para abrir el modal y cargar los datos del usuario a editar
        $('.btn-editar').click(function(){
            var idUsuario = $(this).data('id');
            var nombreUsuario = $(this).data('nombre');
            var telefonoUsuario = $(this).data('telefono');
            var lugarMesa = $(this).data('lugar');
            var espacioMesa = $(this).data('espacio');
            var rolUsuario = $(this).data('rol');
            var passwordUsuario = $(this).data('password');
            $('#idUsuario').val(idUsuario);
            $('#nombreUsuario').val(nombreUsuario);
            $('#telefonoUsuario').val(telefonoUsuario);
            $('#lugarMesa').val(lugarMesa);
            $('#espacioMesa').val(espacioMesa);
            $('#rolUsuario').val(rolUsuario);
            $('#passwordUsuario').val(passwordUsuario);
            $('#modalEditarUsuario').modal('show');
        });

        $('.btn-eliminar').click(function() {
            var idUsuario = $(this).data('id');
            if (confirm('¿Estás seguro de eliminar este usuario?')) {
                $.ajax({
                    url: 'app/eliminar_usuario.php',
                    method: 'POST',
                    data: { idUsuario: idUsuario },
                    success: function(response) {
                        window.location.href = 'visualizar_empleados_admin.php';
                    }
                });
            }
        });

    });
</script>

</body>
</html>
