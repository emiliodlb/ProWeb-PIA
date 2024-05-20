<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];

include_once 'app/conexion.inc.php';

conexion::abrir_conexion();

// Obtener las mesas disponibles de la DB
$sql = "SELECT * FROM usuario WHERE DisponibilidadMesa = 'Disponible'";
$stmt = conexion::obtener_conexion()->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

conexion::cerrar_conexion();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mesas Disponibles</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <style>.mesa {margin-bottom: 20px;}</style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Mesas Disponibles</h1>
        
        <div class="d-flex justify-content-between mb-6">
            <div>
                <a href="inicio.php" class="btn btn-outline-primary">Regresar a Inicio</a>
            </div>
        </div>
        
        <br>
        <div class="row">
            <!-- mesas -->
            <?php
            if (count($resultado) > 0) {
                // Mostrar las mesas disponibles
                foreach ($resultado as $mesa) {
                    ?>
                    <div class="col-md-4 mesa">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Mesa de <?php echo htmlspecialchars($mesa['NombreUsuario']); ?></h5>
                                <p class="card-text">Teléfono: <?php echo htmlspecialchars($mesa['TelefonoUsuario']); ?></p>
                                <p class="card-text">Lugar: <?php echo htmlspecialchars($mesa['LugarMesa']); ?></p>
                                <p class="card-text">Espacio: <?php echo htmlspecialchars($mesa['EspacioMesa']); ?></p>
                                <p class="card-text">Disponibilidad: <?php echo htmlspecialchars($mesa['DisponibilidadMesa']); ?></p>
                                <p class="card-text">Mesa Usuario: <?php echo htmlspecialchars($mesa['MesaUsuario']); ?></p>
                                <p class="card-text">ID Rol: <?php echo htmlspecialchars($mesa['IdRol']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-md-12'>No se encontraron mesas disponibles.</div>";
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>
