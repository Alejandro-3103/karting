<?php
require '../modelos/modelo_reservas.php';

class ReservasController extends modelo_reservas {
    
    // Mostrar lista de reservas
    public function ListView() {
        session_start();
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['nombre_usuario'] !== 'admin') {
            // Redirigir al login si no es admin
            header("Location: ../vistas/socio/login.php"); 
            exit();
        }

        $reservas = $this->obtener_reservas();
        require '../vistas/reservas/lista_reservas.php';  // Vista para listar las reservas
    }

    // Mostrar formulario de creación de una reserva
    public function CreateView() {
        session_start();
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['nombre_usuario'] !== 'admin') {
            // Redirigir al login si no es admin
            header("Location: ../vistas/socio/login.php"); 
            exit();
        }

        $usuarios = $this->obtener_socios();
        $pistas = $this->obtener_pistas();
        require '../vistas/reservas/crear_reserva.php';  // Vista para crear una nueva reserva
    }
    
    // Insertar una nueva reserva
    public function InsertReserva($socio_id, $pista_id, $fecha_hora, $duracion_minutos, $numero_participantes) {
        $this->insertar_reserva($socio_id, $pista_id, $fecha_hora, $duracion_minutos, $numero_participantes);
        header("Location: ReservasController.php?action=list");
        exit();
    }  
    
    // Eliminar una reserva
    public function DeleteReserva($id) {
        $this->eliminar_reserva($id);
        header("Location: ReservasController.php?action=list");
        exit();
    }    
    
    // Buscar reservas por criterio
    public function SearchView($query) {
        $reservas = $this->buscar_reservas($query);
        require '../vistas/reservas/lista_reservas.php';  // Vista para mostrar los resultados de la búsqueda
    }    
}

// Manejo de acciones
if (isset($_GET['action'])) {
    $controller = new ReservasController();

    switch ($_GET['action']) {
        case 'list':
            $controller->ListView();
            break;

        case 'create':
            $controller->CreateView();
            break;

        case 'insert':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->InsertReserva($_POST['socio_id'], $_POST['pista_id'], $_POST['fecha_hora'], $_POST['duracion_minutos'], $_POST['numero_participantes']);
            }
            break;
        
         case 'delete':
            if (isset($_GET['id'])) {
                $controller->DeleteReserva($_GET['id']);
            }
            break;

        case 'search':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->SearchView($_POST['search_query']);
            }
            break;
        
        default:
            echo "Acción no válida";
    }
}
?>

