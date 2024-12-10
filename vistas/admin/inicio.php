<?php
session_start();
// Comprobar si el usuario está autenticado y si es el admin
if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado'] || $_SESSION['nombre_usuario'] !== 'admin') {
    // Si no está autenticado o no es admin, redirigir a la página de login
    header("Location: ../vistas/socio/login.php");
    exit();
}

// Código para la página principal del admin
echo "Bienvenido al área de administración.";
// Aquí puedes colocar el contenido de la página del admin.
?>
<a href="../logout.php">Cerrar sesión</a>