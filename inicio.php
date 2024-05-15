<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/inicio.css">
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
        <br><br>
        <div class="row">
            <div class="col-md-4">
                <a href="generar_orden.php" class="btn btn-secondary btn-dashboard">
                    Generar Orden
                    <img src="img/generar_orden.png">
                </a>
            </div>
            <div class="col-md-4">
                <a href="mesas_disponibles.php" class="btn btn-secondary btn-dashboard">
                    Mesas Disponibles
                    <img src="img/mesas_disponibles.png">
                </a>
            </div>
            <div class="col-md-4">
                <a href="historial_ordenes.php" class="btn btn-secondary btn-dashboard">
                    Historial de Órdenes
                    <img src="img/historial_ordenes.png">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="modificar_orden.php" class="btn btn-secondary btn-dashboard">
                    Modificar Orden
                    <img src="img/modificar_orden.png">
                </a>
            </div>
            <div class="col-md-4">
                <a href="visualizar_productos.php" class="btn btn-secondary btn-dashboard">
                    Visualizar Productos
                    <img src="img/visualizar_productos.png">
                </a>
            </div>
            <div class="col-md-4">
                <a href="visualizar_empleados.php" class="btn btn-secondary btn-dashboard">
                    Visualizar Empleados
                    <img src="img/visualizar_empleados.png">
                </a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="scripts/bootstrap.bundle.min.js"></script>
</body>
</html>
