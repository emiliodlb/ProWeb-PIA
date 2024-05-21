<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];

include_once 'app/conexion.inc.php';

conexion::abrir_conexion();

// Procesar cambio de disponibilidad
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idusuario'])) {
    $idUsuario = $_POST['idusuario'];
    $nuevaDisponibilidad = $_POST['disponibilidad'] == 1 ? 0 : 1;

    $sql = "UPDATE usuario SET DisponibilidadMesa = :disponibilidad WHERE IdUsuario = :idusuario";
    $stmt = conexion::obtener_conexion()->prepare($sql);
    $stmt->bindParam(':disponibilidad', $nuevaDisponibilidad);
    $stmt->bindParam(':idusuario', $idUsuario);
    $stmt->execute();
}

// Obtener las mesas con IdRol 3 de la DB
$sql = "SELECT * FROM usuario WHERE IdRol = 3";
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
                // Mostrar las mesas con IdRol 3
                foreach ($resultado as $mesa) {
                    ?>
                    <div class="col-md-4 mesa">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($mesa['NombreUsuario']); ?></h5>
                                <p class="card-text">Lugar: <?php echo htmlspecialchars($mesa['LugarMesa']); ?></p>
                                <p class="card-text">Espacio: <?php echo htmlspecialchars($mesa['EspacioMesa']); ?></p>
                                <p class="card-text">Disponibilidad: 
                                    <?php echo $mesa['DisponibilidadMesa'] == 1 ? 'DISPONIBLE' : 'OCUPADA'; ?>
                                </p>
                                <p class="card-text">ID Rol: <?php echo htmlspecialchars($mesa['IdRol']); ?></p>
                                <!-- Form para cambiar la disponibilidad -->
                                <form action="#" method="post">
                                    <input type="hidden" name="idusuario" value="<?php echo $mesa['IdUsuario']; ?>">
                                    <input type="hidden" name="disponibilidad" value="<?php echo $mesa['DisponibilidadMesa']; ?>">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo $mesa['DisponibilidadMesa'] == 1 ? 'Marcar como Ocupada' : 'Marcar como Disponible'; ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-md-12'>No se encontraron mesas.</div>";
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>
