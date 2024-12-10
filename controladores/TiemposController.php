<?php
require '../modelos/modelo_tiempos.php';

class TiemposController extends modelo_tiempos {

    // Mostrar la lista de tiempos
    public function ListView() {
        session_start();
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['nombre_usuario'] !== 'admin') {
            // Redirigir al login si no es admin
            header("Location: ../vistas/socio/login.php"); 
            exit();
        }

        $tiempos = $this->obtener_tiempos_con_nombres(); // Método modificado para incluir nombres
        require '../vistas/tiempos/lista_tiempos.php';  // Vista para listar los tiempos
    }

    // Mostrar formulario para crear un nuevo tiempo
    public function CreateView() {
        session_start();
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['nombre_usuario'] !== 'admin') {
            // Redirigir al login si no es admin
            header("Location: ../vistas/socio/login.php"); 
            exit();
        }

        $socios = $this->obtener_socios(); // Método adicional para obtener socios
        $pistas = $this->obtener_pistas(); // Método adicional para obtener pistas
        require '../vistas/tiempos/crear_tiempo.php';  // Vista para crear un nuevo tiempo
    }

    // Insertar un nuevo tiempo
    public function InsertTiempo($socio_id, $pista_id, $tiempo, $fecha) {
        $this->insertar_tiempo($socio_id, $pista_id, $tiempo, $fecha);
        header("Location: TiemposController.php?action=list");
        exit();
    }

    // Mostrar formulario para actualizar un tiempo
    public function UpdateView($id) {
        session_start();
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['nombre_usuario'] !== 'admin') {
            // Redirigir al login si no es admin
            header("Location: ../vistas/socio/login.php"); 
            exit();
        }

        $tiempo = $this->buscar_tiempo($id);
        $socios = $this->obtener_socios();
        $pistas = $this->obtener_pistas();

        if (is_array($tiempo) && count($tiempo) > 0) {
            $tiempo = $tiempo[0];
            require '../vistas/tiempos/actualizar_tiempo.php';  // Vista para actualizar el tiempo
        } else {
            echo "Tiempo no encontrado";
        }
    }

    // Actualizar un tiempo
    public function UpdateTiempo($id, $socio_id, $pista_id, $tiempo, $fecha) {
        $this->actualizar_tiempo($id, $socio_id, $pista_id, $tiempo, $fecha);
        header("Location: TiemposController.php?action=list");
        exit();
    }

    // Eliminar un tiempo
    public function DeleteTiempo($id) {
        $this->eliminar_tiempo($id);
        header("Location: TiemposController.php?action=list");
        exit();
    }

    // Buscar tiempos por nombre de socio
    public function BuscarPorNombreSocio($nombre_socio) {
        $resultados = $this->buscar_tiempos_por_nombre_socio($nombre_socio);
        require '../vistas/tiempos/lista_tiempos.php';  // Vista para mostrar los resultados de la búsqueda
    }
}

// Manejo de acciones
if (isset($_GET['action'])) {
    $controller = new TiemposController();

    switch ($_GET['action']) {
        case 'list':
            $controller->ListView();
            break;

        case 'create':
            $controller->CreateView();
            break;

        case 'insert':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->InsertTiempo($_POST['socio_id'], $_POST['pista_id'], $_POST['tiempo'], $_POST['fecha']);
            }
            break;

        case 'update':
            if (isset($_GET['id'])) {
                $controller->UpdateView($_GET['id']);
            }
            break;

        case 'save_update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->UpdateTiempo($_POST['id'], $_POST['socio_id'], $_POST['pista_id'], $_POST['tiempo'], $_POST['fecha']);
            }
            break;

        case 'delete':
            if (isset($_GET['id'])) {
                $controller->DeleteTiempo($_GET['id']);
            }
            break;

        case 'search':
            if (isset($_POST['nombre_socio'])) {
                $resultados = $controller->buscar_tiempos_por_nombre_socio($_POST['nombre_socio']);
                $tiempos = $resultados; // Los resultados de la búsqueda reemplazan el listado
                require '../vistas/tiempos/lista_tiempos.php';  // Vista para mostrar los resultados
            }
            break;

        default:
            echo "Acción no válida";
    }
}
?>
