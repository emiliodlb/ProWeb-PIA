<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="shortcut icon" href="img/icon_logo.png">
</head>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="index.html">
                <img src="img/icon_logo.png" alt="" width="30" height="30" class="d-inline-block align-top">
                FlashFeast
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="">Login<span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Quienes_Somos.html">Quiénes Somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Sucursales</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card login-form">
                    <div class="card-body">
                        <h2 class="card-title text-center">Login</h2>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            include_once 'app/conexion.inc.php';

                            conexion::abrir_conexion();

                            $username = $_POST['username'];
                            $password = $_POST['password'];

                            $stmt = conexion::obtener_conexion()->prepare("SELECT * FROM usuario WHERE NombreUsuario = ? AND PasswordUsuario = ?");
                            $stmt->execute([$username, $password]);
                            $usuario = $stmt->fetch();

                            conexion::cerrar_conexion();

                            if ($usuario) {
                                session_start();
                                $_SESSION['usuario'] = $usuario;
                                header('Location: inicio.php');
                            } else {
                                echo '<div class="alert alert-danger" role="alert">Nombre de usuario o contraseña incorrectos.</div>';
                            }
                        }
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="username">Nombre de Usuario:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                        </form>
                        <a href="index.html" class="btn btn-secondary btn-block back-to-index">Regresar a la página de inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="scripts/bootstrap.bundle.min.js"></script>
</body>
</html>
