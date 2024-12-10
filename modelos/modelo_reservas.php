<?php
require '../bd/bd.php';

class modelo_reservas {
    private $bd;

    public function __construct() {
        $this->bd = conectar::conexion();
    }

    // Insertar nueva reserva
    public function insertar_reserva($socio_id, $pista_id, $fecha_hora, $duracion_minutos, $numero_participantes) {
        // Obtener el precio por duración
        $precio_por_duracion = $this->obtener_precio($pista_id, $duracion_minutos);
        if ($precio_por_duracion === null) {
            echo "Error: No se encontró un precio válido para esta pista y duración.";
            return;
        }
    
        // Calcular el precio total
        $precio_total = $precio_por_duracion * $numero_participantes;
    
        // Insertar la reserva
        $consulta = $this->bd->prepare("INSERT INTO reservas (socio_id, pista_id, fecha_hora, duracion_minutos, numero_participantes, precio_total, estado) 
                                        VALUES (?, ?, ?, ?, ?, ?, 'pendiente')");
        $consulta->bind_param("iisidi", $socio_id, $pista_id, $fecha_hora, $duracion_minutos, $numero_participantes, $precio_total);
    
        if ($consulta->execute()) {
            echo "Reserva realizada exitosamente";
        } else {
            echo "Error al realizar la reserva: " . $consulta->error;
        }
    
        $consulta->close();
    }
    
    // Obtener precio por pista y duración
    private function obtener_precio($pista_id, $duracion_minutos) {
        $consulta = $this->bd->prepare("SELECT precio FROM precios WHERE pista_id = ? AND duracion_minutos = ?");
        $consulta->bind_param("ii", $pista_id, $duracion_minutos);
        $consulta->execute();
        $resultado = $consulta->get_result();

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            return $row['precio'];
        } else {
            return null; // No se encontró un precio
        }
    }

    public function existe_reserva($pista_id, $fecha_hora) {
        $consulta = $this->bd->prepare("SELECT COUNT(*) AS total FROM reservas WHERE pista_id = ? AND fecha_hora = ?");
        $consulta->bind_param("is", $pista_id, $fecha_hora);
        $consulta->execute();
        $resultado = $consulta->get_result()->fetch_assoc();
    
        return $resultado['total'] > 0; // Devuelve true si ya existe una reserva
    }    

    // Obtener todas las reservas
    public function obtener_reservas() {
        $consulta = $this->bd->prepare("
            SELECT reservas.*, pistas.nombre AS nombre_pista, socios.nombre_usuario AS nombre_socio
            FROM reservas
            JOIN pistas ON reservas.pista_id = pistas.id
            JOIN socios ON reservas.socio_id = socios.id
        ");
        $consulta->execute();
        $resultados = $consulta->get_result();

        return $resultados->fetch_all(MYSQLI_ASSOC);
    }

    public function eliminar_reserva($id) {
        $consulta = $this->bd->prepare("DELETE FROM reservas WHERE id = ?");
        $consulta->bind_param("i", $id);
    
        if ($consulta->execute()) {
            echo "Reserva eliminada exitosamente.";
        } else {
            echo "Error al eliminar la reserva: " . $consulta->error;
        }
    
        $consulta->close();
    }
    
    // Obtener todos los socios
    public function obtener_socios() {
        $consulta = $this->bd->prepare("SELECT id, nombre_usuario FROM socios");
        $consulta->execute();
        $resultados = $consulta->get_result();
        return $resultados->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener todas las pistas
    public function obtener_pistas() {
        $consulta = $this->bd->prepare("SELECT id, nombre FROM pistas");
        $consulta->execute();
        $resultados = $consulta->get_result();
        return $resultados->fetch_all(MYSQLI_ASSOC);
    }

    public function buscar_reservas($query) {
        $consulta = $this->bd->prepare("
            SELECT reservas.*, pistas.nombre AS nombre_pista, socios.nombre_usuario AS nombre_socio
            FROM reservas
            JOIN pistas ON reservas.pista_id = pistas.id
            JOIN socios ON reservas.socio_id = socios.id
            WHERE socios.nombre_usuario LIKE ? OR pistas.nombre LIKE ?
        ");
        $param = '%' . $query . '%';
        $consulta->bind_param("ss", $param, $param);
        $consulta->execute();
        $resultados = $consulta->get_result();
    
        return $resultados->fetch_all(MYSQLI_ASSOC);
    }
    
    public function obtener_reservas_por_usuario($usuario_id) {
        $consulta = $this->bd->prepare("
            SELECT reservas.*, pistas.nombre AS nombre_pista
            FROM reservas
            JOIN pistas ON reservas.pista_id = pistas.id
            WHERE reservas.socio_id = ?
        ");
        $consulta->bind_param("i", $usuario_id);
        $consulta->execute();
        return $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
}
?>

