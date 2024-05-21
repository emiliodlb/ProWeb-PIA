<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios del Restaurante</title>
    <link href="styles/mesa.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Usuarios del Restaurante</h1>
        <BR>
        <a href="inicio.php" class="btn btn-secondary mb-3">Ir a Inicio</a><BR>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Lugar Mesa</th>
                    <th>Espacio Mesa</th>
                    <th>Disponibilidad Mesa</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once 'app/conexion.inc.php';
                conexion::abrir_conexion();
                $conexion = conexion::obtener_conexion();
                
                $sql = 'SELECT * FROM usuario WHERE IdRol = 3';
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $usuarios = $sentencia->fetchAll();

                foreach ($usuarios as $usuario) {
                    $row_class = $usuario['DisponibilidadMesa'] ? 'disponible' : 'no-disponible';
                    echo '<tr class="' . $row_class . '">';
                    echo '<td>' . $usuario['NombreUsuario'] . '</td>';
                    echo '<td>' . $usuario['LugarMesa'] . '</td>';
                    echo '<td>' . $usuario['EspacioMesa'] . '</td>';
                    echo '<td>' . ($usuario['DisponibilidadMesa'] ? 'Disponible' : 'No Disponible') . '</td>';
                    echo '<td>';
                    echo '<form action="app/mesasdisponibles.php" method="post" style="display:inline-block;">';
                    echo '<input type="hidden" name="idusuario" value="' . $usuario['IdUsuario'] . '">';
                    echo '<button type="submit" name="disponibilidad" value="1" class="btn btn-success">Disponible</button>';
                    echo '</form>';
                    echo '<form action="app/mesasdisponibles.php" method="post" style="display:inline-block;">';
                    echo '<input type="hidden" name="idusuario" value="' . $usuario['IdUsuario'] . '">';
                    echo '<button type="submit" name="disponibilidad" value="0" class="btn btn-danger">No Disponible</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }

                conexion::cerrar_conexion();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
