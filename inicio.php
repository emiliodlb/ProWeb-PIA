<!DOCTYPE html>
<html>
<head>
    <title>Inicio - Usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/inicio.css">
    <link rel="shortcut icon" href="img/icon_logo.png">
</head>
<body>
    <div class="container">
        <?php
        session_start();

        if (!isset($_SESSION['usuario'])) {
            header('Location: login.php');
            exit;
        }

        $usuario = $_SESSION['usuario'];
        ?>

        <h1 class="text-center">Bienvenido, <?php echo $usuario['NombreUsuario']; ?>!</h1>
        <br>
        <br>
        <div class="row">
            <?php
            $rol = $usuario['IdRol'];
            switch ($rol) {
                case 1: // Si el rol es 1
                    $generar_orden_link = 'index_carrito.php';
                    $mesas_disponibles_link = 'mesas_disponibles.php';
                    $historial_ordenes_link = 'historial_ordenes.php';
                    $modificar_orden_link = 'modificar_orden.php';
                    $visualizar_productos_link = 'visualizar_productos_admin.php';
                    $visualizar_empleados_link = 'visualizar_empleados_admin.php';
                    break;
                case 2: // Si el rol es 2
                    $generar_orden_link = 'index_carrito.php';
                    $mesas_disponibles_link = 'mesas_disponibles.php';
                    $historial_ordenes_link = 'historial_ordenes.php';
                    $modificar_orden_link = 'modificar_orden.php';
                    $visualizar_productos_link = 'visualizar_productos.php';
                    $visualizar_empleados_link = 'visualizar_empleados.php';
                    break;
                case 3: // Si el rol es 3
                    $generar_orden_link = 'index_carrito.php';
                    $mesas_disponibles_link = 'mesas_disponibles.php';
                    $historial_ordenes_link = 'historial_ordenes.php';
                    $modificar_orden_link = 'modificar_orden.php';
                    $visualizar_productos_link = '#';
                    $visualizar_empleados_link = '#';
                    break;
                default:
                    
                    break;
            }
            ?>

            <div class="col-md-4">
                <a href="<?php echo $generar_orden_link; ?>" class="btn btn-secondary btn-dashboard">
                    Generar Orden
                    <img src="img/generar_orden.png">
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo $mesas_disponibles_link; ?>" class="btn btn-secondary btn-dashboard">
                    Mesas Disponibles
                    <img src="img/mesas_disponibles.png">
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo $historial_ordenes_link; ?>" class="btn btn-secondary btn-dashboard">
                    Historial de Órdenes
                    <img src="img/historial_ordenes.png">
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo $modificar_orden_link; ?>" class="btn btn-secondary btn-dashboard">
                    Estatus de Orden
                    <img src="img/modificar_orden.png">
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo $visualizar_productos_link; ?>" class="btn btn-secondary btn-dashboard">
                    Visualizar Productos
                    <img src="img/visualizar_productos.png">
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo $visualizar_empleados_link; ?>" class="btn btn-secondary btn-dashboard">
                    Visualizar usuarios
                    <img src="img/visualizar_empleados.png">
                </a>
            </div>
        </div>
    </div>
    <div class="container">
    <div class="text-center mt-3">
        <a href="index.html" class="btn btn-secondary back-to-index">Regresar</a>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="scripts/bootstrap.bundle.min.js"></script>
</body>
</html>
