<?php
include_once 'app/conexion.inc.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

try {
    conexion::abrir_conexion();
    $conexion = conexion::obtener_conexion();

    $fechaHoy = date('Y-m-d 23:59:59');
    $fechaDosDiasAntes = date('Y-m-d 00:00:00', strtotime('-2 days'));

    $sql = "SELECT o.*, u.NombreUsuario, e.NombreEstatus
            FROM orden o
            INNER JOIN usuario u ON o.IdMesa = u.IdUsuario
            INNER JOIN estatusorden e ON o.IdEstatusOrden = e.IdEstatusOrden
            WHERE (o.FechaOrden BETWEEN :fechaDosDiasAntes AND :fechaHoy)
            AND (o.IdOrden LIKE :search
            OR u.NombreUsuario LIKE :search)
            ORDER BY o.FechaOrden DESC";
    $sentencia = $conexion->prepare($sql);
    $likeSearch = "%".$search."%";
    $sentencia->bindParam(':fechaDosDiasAntes', $fechaDosDiasAntes, PDO::PARAM_STR);
    $sentencia->bindParam(':fechaHoy', $fechaHoy, PDO::PARAM_STR);
    $sentencia->bindParam(':search', $likeSearch, PDO::PARAM_STR);
    $sentencia->execute();
    $ordenes = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    conexion::cerrar_conexion();
} catch (PDOException $ex) {
    print "ERROR: " . $ex->getMessage() . "<br>";
    die();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Órdenes Recientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/ordenes.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Órdenes Recientes</h1>
        
        <div class="d-flex justify-content-between mb-4">
            <form class="form-inline" method="get" action="">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Buscar" aria-label="Buscar" value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit">Buscar</button>
            </form>
            <a href="inicio.php" class="btn btn-outline-primary">Regresar a Inicio</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm text-center mx-auto">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID Orden</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Fecha de la Orden</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Cambiar Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ordenes as $orden): ?>
                    <tr>
                        <td><?php echo $orden['IdOrden']; ?></td>
                        <td><?php echo $orden['NombreUsuario']; ?></td>
                        <td><?php echo $orden['FechaOrden']; ?></td>
                        <td><?php echo $orden['NombreEstatus']; ?></td>
                        <td>
                            <form action="cambiar_estatus.php" method="post">
                                <input type="hidden" name="idOrden" value="<?php echo $orden['IdOrden']; ?>">
                                <select class="form-control" name="nuevoEstatus">
                                    <option value="1" <?php if($orden['IdEstatusOrden'] == 1) echo 'selected'; ?>>ACTIVO</option>
                                    <option value="2" <?php if($orden['IdEstatusOrden'] == 2) echo 'selected'; ?>>PREPARANDO</option>
                                    <option value="3" <?php if($orden['IdEstatusOrden'] == 3) echo 'selected'; ?>>ENTREGADO</option>
                                    <option value="4" <?php if($orden['IdEstatusOrden'] == 4) echo 'selected'; ?>>CANCELADA</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Cambiar</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
