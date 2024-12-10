<?php
require '../modelos/modelo_socios.php';
require './loginController.php';
$ics = new loginController();

class SocioController extends modelo_socios {
    
    // Función para mostrar la vista de login
    public function LoginView(){
        require '../vistas/socio/login.php';
    }

    // Función para mostrar la vista de inserción de un nuevo socio
    public function InsertView(){
        require '../vistas/socio/login.php';
    }

    // Función para listar socios
    public function ListView() {
        // Verificar si el usuario está logueado y es admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['nombre_usuario'] !== 'admin') {
            header("Location: ../vistas/socio/login.php"); 
            exit();
        }
        
        // Si es admin, continuamos y mostramos la lista de socios
        $socios = $this->obtener_socios();
        require '../vistas/socio/vista_socios.php'; // Vista para listar todos los socios
    }

    // Mostrar formulario de actualización de socio
    public function UpdateView($id_socio){
        // Buscar al socio por ID
        $infosocio = $this->Buscar_socio_por_id($id_socio);
        
        if (is_array($infosocio) && count($infosocio) > 0) {
            require '../vistas/socio/actualizar.php';  // Vista para actualizar los datos
        } else {
            echo "Socio no encontrado";
        }
    }

    // Actualizar datos del socio
    public function UpdateSocio($id_socio, $nombre_usuario, $contraseña, $email){
        $password = password_hash($contraseña, PASSWORD_BCRYPT);  // Encriptar la contraseña
        $this->actualizar_socio($id_socio, $nombre_usuario, $password, $email);
    }

    // Eliminar socio
    public function DeleteSocio($id_socio){
        $this->eliminar_socio($id_socio);
    }

    public function ListarSocios() {
        $socios = $this->obtener_socios();
        require '../vistas/socio/vista_socios.php';  // Vista para listar todos los socios
    }    

    // Verificar login del socio
    public function VerifyLogin($nombre_usuario, $contraseña) {
        // Buscar al socio
        $infosocio = $this->Buscar_socio($nombre_usuario);
    
        // Verificar si el usuario existe
        if (is_array($infosocio) && count($infosocio) > 0) {
            $socio = $infosocio[0];
            
            // Si el usuario es admin, compararemos la contraseña en texto plano
            if ($socio['nombre_usuario'] === 'admin') {
                if ($contraseña === $socio['contrasena']) {
                    // Iniciar sesión y redirigir al área principal
                    session_start();
                    $_SESSION['usuario_id'] = $socio['id'];
                    $_SESSION['nombre_usuario'] = $socio['nombre_usuario'];
                    $_SESSION['autenticado'] = true;
    
                    // Redirigir al área de administrador
                    header("Location: ../controladores/PistaController.php?action=list");
                    exit();
                } else {
                    echo "La contraseña del admin es incorrecta";
                }
            } else {
                // Para otros usuarios, se verifica la contraseña hasheada
                if (password_verify($contraseña, $socio['contrasena'])) {
                    // Iniciar sesión y redirigir al área principal
                    session_start();
                    $_SESSION['usuario_id'] = $socio['id'];
                    $_SESSION['nombre_usuario'] = $socio['nombre_usuario'];
                    $_SESSION['autenticado'] = true;
    
                    // Redirigir a la página principal de los socios
                    header("Location: ../controladores/UsuarioController.php?action=view&user_id=" . $socio['id']);
                    exit();
                } else {
                    echo "La contraseña es incorrecta";
                }
            }
        } else {
            echo "No se encontró el usuario.";
        }
    } 
}

if (isset($_GET['action']) && $_GET['action'] == 'login') {
    $instanciacontrolador = new SocioController();
    $instanciacontrolador->LoginView();
}

if (isset($_GET['action']) && $_GET['action'] == 'insert') {
    $instanciacontrolador = new SocioController();
    $instanciacontrolador->InsertView();
}

if (isset($_POST['action']) && $_POST['action'] == 'insert') {
    $instanciacontrolador = new SocioController();
    $password = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
    $instanciacontrolador->insertar_socio(
        $_POST['nombre'],
        $password,
        $_POST['email']
    );
}

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $instanciacontrolador = new SocioController();
    $instanciacontrolador->VerifyLogin($_POST['nombre'], $_POST['contraseña']);
}

if (isset($_GET['action'])) {
    $instanciacontrolador = new SocioController();

    // Acción para listar socios
    if ($_GET['action'] == 'list') {
        $instanciacontrolador->ListView();
    }

    // Acción para mostrar la vista de actualización
    if ($_GET['action'] == 'update') {
        if (isset($_GET['id_socio'])) {
            $instanciacontrolador->UpdateView($_GET['id_socio']);
        } else {
            echo "ID de socio no proporcionado.";
        }
    }

    // Acción para eliminar un socio
    if ($_GET['action'] == 'delete') {
        if (isset($_GET['id_socio'])) {
            $instanciacontrolador->DeleteSocio($_GET['id_socio']);
            header("Location: SocioController.php?action=list"); // Redirige después de eliminar
        } else {
            echo "ID de socio no proporcionado.";
        }
    }
}

if (isset($_POST['action'])) {
    $instanciacontrolador = new SocioController();

    // Acción para actualizar un socio
    if ($_POST['action'] == 'update') {
        $instanciacontrolador->UpdateSocio(
            $_POST['id_socio'],
            $_POST['nombre_usuario'],
            $_POST['contraseña'],
            $_POST['email']
        );
        header("Location: SocioController.php?action=list"); // Redirige después de actualizar
    }
}

if ($_GET['action'] == 'search' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['nombre_usuario'])) {
        $nombre_usuario = $_POST['nombre_usuario'];
        $socios = $instanciacontrolador->Buscar_socio($nombre_usuario);
    } else {
        // Si no se ingresó nada, mostramos todos los socios
        $socios = $instanciacontrolador->obtener_socios();
    }
    require '../vistas/socio/vista_socios.php';
}

?>
