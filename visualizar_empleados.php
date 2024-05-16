<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Usuarios Registrados</h2>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Lugar Mesa</th>
                <th>Espacio Mesa</th>
                <th>Disponibilidad Mesa</th>
                <th>Rol</th>
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
                echo '<td>' . ($fila['DisponibilidadMesa'] ? 'Sí' : 'No') . '</td>';
                echo '<td>' . $fila['IdRol'] . '</td>';
                echo '</tr>';
            }

            conexion::cerrar_conexion();
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function() {

        obtenerUsuarios();

        function obtenerUsuarios() {
            $.ajax({
                url: 'obtener_usuarios.php',
                method: 'GET',
                success: function(data) {
                    $('#tabla-usuarios').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
</script>

</body>
</html>
