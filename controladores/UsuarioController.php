<?php
require '../modelos/modelo_usuario.php';

class UsuarioController extends modelo_usuario {

    // Verifica si el usuario está autenticado
    public function VerificarSesionUsuario() {
        session_start();
        
        // Comprobamos si el usuario está autenticado
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
            // Si no está autenticado, redirigir al login
            header("Location: ../vistas/socio/login.php");
            exit();
        }
    }

    // Carga la vista de usuario con los datos necesarios
    public function UserView($userId) {
        $this->VerificarSesionUsuario();  // Verificar que el usuario esté logueado

        // Obtener los datos necesarios para mostrar en la vista
        $pistas = $this->obtener_pistas();
        $precios = $this->obtener_precios();
        $tiempos = $this->obtener_tiempos();
        $mis_reservas = $this->obtener_reservas_usuario($userId);

        // Ahora se carga la vista pasando los datos
        require '../vistas/usuario/usuario_vista.php';
    }

    public function InsertReserva($userId) {
        session_start();
    
        if (!isset($_SESSION['usuario_id'])) {
            echo "No hay usuario autenticado.";
            exit();
        }
        
        $userId = $_SESSION['usuario_id'];
        // Continuar con la inserción
        $this->insertar_reserva($userId, $_POST['pista_id'], $_POST['fecha_hora'], $_POST['duracion_minutos'], $_POST['numero_participantes']);
        header("Location: UsuarioController.php?action=view&user_id=" . $userId);
        exit();
    }
    
    public function UpdateEstadoReserva($reservaId, $userId) {
        session_start();
        if (isset($_GET['estado'])) {
            $estado = $_GET['estado'];
            $userId = $_SESSION['usuario_id'];
            
            // Cambia el estado según la acción seleccionada
            if ($estado === 'confirmar') {
                $this->cambiar_estado_reserva($reservaId, 'confirmada'); // Implementa lógica para confirmar
            } elseif ($estado === 'cancelar') {
                $this->cambiar_estado_reserva($reservaId, 'cancelada'); // Implementa lógica para cancelar
            } else {
                echo "Estado no válido.";
                exit();
            }
    
            // Redirigir de vuelta al panel del usuario
            header("Location: UsuarioController.php?action=view&user_id=$userId");
            exit();
        } else {
            echo "No se especificó el estado.";
            exit();
        }
    }
    
}

// Manejo de acciones
if (isset($_GET['action'])) {
    $controller = new UsuarioController();
    $userId = $_GET['user_id'] ?? null;

    switch ($_GET['action']) {
        case 'view':
            $controller->UserView($userId);
            break;

        case 'insert_reserva':
            $controller->InsertReserva($userId);
            break;

        case 'update_estado':
            $controller->UpdateEstadoReserva($_GET['id'], $userId);
            break;

        default:
            echo "Acción no válida";
    }
}

?>
