<?php
require '../modelos/modelo_pistas.php';
class PistaController extends modelo_pistas {

    // Mostrar vista de listado de pistas
    public function ListView() {
        session_start();
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['nombre_usuario'] !== 'admin') {
            header("Location: ../vistas/socio/login.php"); 
            exit();
        }
        
        $pistas = $this->obtener_pistas();
        require '../vistas/pista/vista_pistas.php';  // Vista para listar las pistas
    }

    // Mostrar formulario para agregar una nueva pista
    public function InsertView() {
        session_start();
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['nombre_usuario'] !== 'admin') {
            header("Location: ../vistas/socio/login.php"); 
            exit();
        }

        require '../vistas/pista/insertar_pista.php';  // Vista para agregar una nueva pista
    }

    // Insertar nueva pista
    public function InsertPista($nombre, $descripcion) {
        $this->insertar_pista($nombre, $descripcion);
    }

    // Mostrar formulario de actualización de pista
    public function UpdateView($id) {
        session_start();
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['nombre_usuario'] !== 'admin') {
            header("Location: ../vistas/socio/login.php"); 
            exit();
        }

        $infoPista = $this->buscar_pista_por_id($id);  // Necesitarás una función para buscar por ID
        if (is_array($infoPista) && count($infoPista) > 0) {
            require '../vistas/pista/actualizar_pista.php';  // Vista para actualizar la pista
        } else {
            echo "Pista no encontrada";
        }
    }

    // Actualizar datos de la pista
    public function UpdatePista($id, $nombre, $descripcion) {
        $this->actualizar_pista($id, $nombre, $descripcion);
    }

    // Eliminar pista
    public function DeletePista($id) {
        $this->eliminar_pista($id);
    }
}

// Manejar las acciones solicitadas
if (isset($_GET['action'])) {
    $controlador = new PistaController();

    // Acción para listar pistas
    if ($_GET['action'] == 'list') {
        $controlador->ListView();
    }

    // Acción para mostrar formulario de inserción
    if ($_GET['action'] == 'insert') {
        $controlador->InsertView();
    }

    // Acción para mostrar formulario de actualización
    if ($_GET['action'] == 'update') {
        if (isset($_GET['id'])) {
            $controlador->UpdateView($_GET['id']);
        } else {
            echo "ID de pista no proporcionado.";
        }
    }

    // Acción para eliminar una pista
    if ($_GET['action'] == 'delete') {
        if (isset($_GET['id'])) {
            $controlador->DeletePista($_GET['id']);
            header("Location: PistaController.php?action=list");
        } else {
            echo "ID de pista no proporcionado.";
        }
    }
}

if (isset($_POST['action'])) {
    $controlador = new PistaController();

    // Acción para insertar una nueva pista
    if ($_POST['action'] == 'insert') {
        $controlador->InsertPista($_POST['nombre'], $_POST['descripcion']);
        header("Location: PistaController.php?action=list");
    }

    // Acción para actualizar una pista
    if ($_POST['action'] == 'update') {
        $controlador->UpdatePista($_POST['id'], $_POST['nombre'], $_POST['descripcion']);
        header("Location: PistaController.php?action=list");
    }
}
?>
