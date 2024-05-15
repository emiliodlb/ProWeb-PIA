<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlashFeast - Inicio</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="shortcut icon" href="img/icon_logo.png">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="">
                <img src="img/icon_logo.png" alt="" width="30" height="30" class="d-inline-block align-top">
                FlashFeast
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Quiénes Somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Sucursales</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <section class="portada">
        <div class="container">
            <h1>Bienvenidos a FlashFeast</h1>
            <p><b>Disfruta de nuestra deliciosa comida y excelente servicio</b></p>
            <a href="login.php" class="btn btn-secondary">PEDIR AHORA</a>
        </div>
        </section>
        <section class="features">
            <div class="container">
                <h2>Nuestros Servicios</h2>
                <div class="row">
                    <div class="col-md-4">
                        <i class="fas fa-utensils"></i>
                        <h3>Informes de Restaurante</h3>
                        <p>Noticias y actaulizaciones de nuesta cadena de restaurantes.</p>
                    </div>
                    <div class="col-md-4">
                        <i class="fas fa-truck"></i>
                        <h3>Localizacion de Sucursales</h3>
                        <p>Localiza rapidamente las sucursales disponibles en la Zona Metropolitana de Monterrey.</p>
                    </div>
                    <div class="col-md-4">
                        <i class="fas fa-smile"></i>
                        <h3>¡Pidé tu mismo!</h3>
                        <p>Pide tu orden desde la comodidad de la mesa sin la necesidad de un mesero.</p>
                    </div>
                </div>
            </div>
            <br>
            <div class='db_test'>
                <?php
                include_once 'app/conexion.inc.php';
                conexion :: abrir_conexion(); 
                conexion :: cerrar_conexion();
                ?>
            </div>
            
            
        </section>
    </main>
    <footer>
        <div class="container">
            <p>&copy; Pagina Creada por Emilio Briones y Efren Arellano</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="scripts/bootstrap.bundle.min.js"></script>
    <script src=""></script>
</body>
</html>