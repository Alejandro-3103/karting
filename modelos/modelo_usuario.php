<?php
require '../bd/bd.php';

class modelo_usuario {
    private $bd;

    public function __construct() {
        $this->bd = conectar::conexion();
    }

    public function obtener_pistas() {
        $consulta = $this->bd->prepare("SELECT * FROM pistas");
        $consulta->execute();
        return $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function obtener_precios() {
        $consulta = $this->bd->prepare("
            SELECT precios.*, pistas.nombre AS nombre_pista 
            FROM precios 
            JOIN pistas ON precios.pista_id = pistas.id
        ");
        $consulta->execute();
        return $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function obtener_tiempos() {
        $consulta = $this->bd->prepare("
            SELECT tiempos.tiempo, socios.nombre_usuario AS nombre_socio, pistas.nombre AS nombre_pista 
            FROM tiempos
            JOIN socios ON tiempos.socio_id = socios.id 
            JOIN pistas ON tiempos.pista_id = pistas.id
            ORDER BY tiempos.tiempo ASC
        ");
        $consulta->execute();
        return $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function obtener_reservas_usuario($userId) {
        $consulta = $this->bd->prepare("
            SELECT reservas.*, pistas.nombre AS nombre_pista 
            FROM reservas 
            JOIN pistas ON reservas.pista_id = pistas.id 
            WHERE reservas.socio_id = ?
        ");
        $consulta->bind_param("i", $userId);
        $consulta->execute();
        return $consulta->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function insertar_reserva($userid, $pista_id, $fecha_hora, $duracion_minutos, $numero_participantes) {
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
        $consulta->bind_param("iisidi", $userid, $pista_id, $fecha_hora, $duracion_minutos, $numero_participantes, $precio_total);
    
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
                return null; 
            }
    }

    public function cambiar_estado_reserva($reservaId, $nuevoEstado) {
        $sql = "UPDATE reservas SET estado = ? WHERE id = ?";
        $stmt = $this->bd->prepare($sql);
        $stmt->bind_param('si', $nuevoEstado, $reservaId);
        $stmt->execute();
    }    
}
?>