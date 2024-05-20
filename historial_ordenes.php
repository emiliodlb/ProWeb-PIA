<?php
require_once 'app/conexion.inc.php';
conexion::abrir_conexion();
$conn = conexion::obtener_conexion();

$query = "SELECT o.IdOrden, o.TotalOrden, o.FechaOrden, u.NombreUsuario as Mesa, e.NombreEstatus as Estatus 
          FROM orden o
          JOIN usuario u ON o.IdMesa = u.IdUsuario
          JOIN estatusorden e ON o.IdEstatusOrden = e.IdEstatusOrden
          ORDER BY o.FechaOrden DESC";

$stmt = $conn->prepare($query);
$stmt->execute();
$ordenes = $stmt->fetchAll(PDO::FETCH_ASSOC);

conexion::cerrar_conexion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Órdenes</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="shortcut icon" href="img/icon_logo.png">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Listado de Órdenes</h1>
        <a href="inicio.php" class="btn btn-secondary mb-3">Ir a Inicio</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Orden</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Mesa</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordenes as $orden): ?>
                <tr>
                    <td><?php echo htmlspecialchars($orden['IdOrden']); ?></td>
                    <td><?php echo htmlspecialchars($orden['TotalOrden']); ?></td>
                    <td><?php echo htmlspecialchars($orden['FechaOrden']); ?></td>
                    <td><?php echo htmlspecialchars($orden['Mesa']); ?></td>
                    <td><?php echo htmlspecialchars($orden['Estatus']); ?></td>
                    <td>
                        <a href="http://localhost/proweb/orden_creada.php?idOrden=<?php echo $orden['IdOrden']; ?>" class="btn btn-primary">Ver Recibo</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
