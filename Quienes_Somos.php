<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quienes_Somos</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/quienes_somos.css">
    <link rel="shortcut icon" href="img/icon_logo.png">
</head>
<body>
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
                        <a class="nav-link" href="login.php">Login<span class="sr-only"></span></a>
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
    <div class="dropdown-container">
        <div class="dropdown">
            <button onclick="toggleDropdown()" class="btn btn-primary">Colaboradores</button>
            <div id="dropdownContent" class="dropdown-content">
                <a href="#">Emilio Briones</a>
                <a href="#">Efren Arellano</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="scripts/bootstrap.bundle.min.js"></script>
    <script>
        function toggleDropdown() {
            document.getElementById("dropdownContent").classList.toggle("show");
        }
    </script>
</body>
</html>
