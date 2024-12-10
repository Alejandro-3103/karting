<?php
// Función para el Header del entorno de administración
function adminHeader() {
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panel de Administración</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/styles.css">  <!-- Aquí puedes incluir tu propio CSS -->
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar de navegación -->
                <nav class="col-12 col-md-3 col-lg-2 d-flex flex-column bg-dark text-white min-vh-100 p-3">
                    <h4 class="text-center mb-4">Admin Panel</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../controladores/PistaController.php?action=list">Pistas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../controladores/PreciosController.php?action=list">Precios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../controladores/ReservasController.php?action=list">Reservas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../controladores/TiemposController.php?action=list">Tiempos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../vistas/logout.php">Cerrar sesión</a>
                        </li>
                    </ul>
                </nav>
                
                <!-- Contenido principal -->
                <main class="col-12 col-md-9 col-lg-10">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="#">Panel de Administración</a>
                    </nav>
                    <div class="container mt-4">
    ';
}

// Función para el Footer del entorno de administración
function adminFooter() {
    echo '
                    </div> <!-- Cierre del container para contenido principal -->
                </main> <!-- Cierre del col-10 -->
            </div> <!-- Cierre del row -->
        </div> <!-- Cierre del container-fluid -->
        
        <footer class="bg-dark text-white text-center py-3">
            <p>&copy; ' . date("Y") . ' Karting Emocion. Todos los derechos reservados.</p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    ';
}
?>
