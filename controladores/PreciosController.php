<?php
require '../modelos/modelo_precios.php';

class PreciosController extends modelo_precios {
    
    // Mostrar la vista de listado de precios
    public function ListView() {
        session_start();
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['nombre_usuario'] !== 'admin') {
            // Redirigir al login si no es admin
            header("Location: ../vistas/socio/login.php"); 
            exit();
        }

        $precios = $this->obtener_precios();
        require '../vistas/precios/lista_precios.php';  // Vista para listar los precios
    }

    // Mostrar formulario de creación de un nuevo precio
    public function CreateView() {
        session_start();
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['nombre_usuario'] !== 'admin') {
            // Redirigir al login si no es admin
            header("Location: ../vistas/socio/login.php"); 
            exit();
        }

        require '../vistas/precios/crear_precio.php';  // Vista para crear un nuevo precio
    }

    // Insertar un nuevo precio
    public function InsertPrecio($pista_id, $duracion_minutos, $precio) {
        $this->insertar_precio($pista_id, $duracion_minutos, $precio);
        header("Location: PreciosController.php?action=list");
        exit();
    }
    
    // Mostrar formulario para actualizar un precio
    public function UpdateView($id) {
        session_start();
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['nombre_usuario'] !== 'admin') {
            // Redirigir al login si no es admin
            header("Location: ../vistas/socio/login.php"); 
            exit();
        }

        $precio = $this->buscar_precio($id);
        if (is_array($precio) && count($precio) > 0) {
            $precio = $precio[0]; // Extraemos el primer elemento del array
            require '../vistas/precios/actualizar_precio.php';
        } else {
            echo "Precio no encontrado";
        }
    }

    // Actualizar un precio
    public function UpdatePrecio($id, $pista_id, $duracion_minutos, $precio) {
        $this->actualizar_precio($id, $pista_id, $duracion_minutos, $precio);
        header("Location: PreciosController.php?action=list");
        exit();
    }

    // Eliminar un precio
    public function DeletePrecio($id) {
        $this->eliminar_precio($id);
        header("Location: PreciosController.php?action=list");
        exit();
    }

    // Buscar precios por nombre de pista
    public function BuscarPreciosPorPista($pista_nombre) {
        return $this->buscar_precios_por_pista($pista_nombre);
    }    
}

// Manejo de acciones
if (isset($_GET['action'])) {
    $controller = new PreciosController();

    switch ($_GET['action']) {
        case 'list':
            $controller->ListView();
            break;

        case 'create':
            $controller->CreateView();
            break;

        case 'insert':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->InsertPrecio($_POST['pista_id'], $_POST['duracion'], $_POST['precio']);
            }
            break;

        case 'update':
            if (isset($_GET['id'])) {
                $controller->UpdateView($_GET['id']);
            }
            break;

        case 'save_update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->UpdatePrecio($_POST['id'], $_POST['pista_id'], $_POST['duracion'], $_POST['precio']);
            }
            break;

        case 'delete':
            if (isset($_GET['id'])) {
                $controller->DeletePrecio($_GET['id']);
            }
            break;

        case 'search':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $pista_nombre = $_POST['pista_nombre'];
                $precios = $controller->BuscarPreciosPorPista($pista_nombre);
                require '../vistas/precios/lista_precios.php';
            }
            break;
            
        default:
            echo "Acción no válida";
    }
}
?>
