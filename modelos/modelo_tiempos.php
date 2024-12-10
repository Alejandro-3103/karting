<?php
require '../bd/bd.php';

class modelo_tiempos {
    private $bd;

    public function __construct() {
        $this->bd = conectar::conexion();
    }

    // Insertar nuevo tiempo
    public function insertar_tiempo($socio_id, $pista_id, $tiempo, $fecha) {
        $consulta = $this->bd->prepare("INSERT INTO tiempos (socio_id, pista_id, tiempo, fecha) VALUES (?, ?, ?, ?)");
        $consulta->bind_param("iiss", $socio_id, $pista_id, $tiempo, $fecha);

        if ($consulta->execute()) {
            echo "Tiempo registrado exitosamente";
        } else {
            echo "Error al ejecutar: " . $consulta->error;
        }

        $consulta->close();
    }

    // Buscar tiempo por ID
    public function buscar_tiempo($id) {
        $consulta = $this->bd->prepare("SELECT * FROM tiempos WHERE id = ?");
        $consulta->bind_param("i", $id);
        $consulta->execute();
        $resultados = $consulta->get_result();

        if ($resultados === false) {
            echo "Error al obtener los resultados: " . $consulta->error;
            return [];
        }

        if ($resultados->num_rows > 0) {
            return $resultados->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // Buscar tiempos por socio
    public function buscar_tiempos_por_socio($socio_id) {
        $consulta = $this->bd->prepare("SELECT * FROM tiempos WHERE socio_id = ?");
        $consulta->bind_param("i", $socio_id);
        $consulta->execute();
        $resultados = $consulta->get_result();

        if ($resultados === false) {
            echo "Error al obtener los resultados: " . $consulta->error;
            return [];
        }

        if ($resultados->num_rows > 0) {
            return $resultados->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // Buscar tiempos por pista
    public function buscar_tiempos_por_pista($pista_id) {
        $consulta = $this->bd->prepare("SELECT * FROM tiempos WHERE pista_id = ?");
        $consulta->bind_param("i", $pista_id);
        $consulta->execute();
        $resultados = $consulta->get_result();

        if ($resultados === false) {
            echo "Error al obtener los resultados: " . $consulta->error;
            return [];
        }

        if ($resultados->num_rows > 0) {
            return $resultados->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // Actualizar tiempo
    public function actualizar_tiempo($id, $socio_id, $pista_id, $tiempo, $fecha) {
        $consulta = $this->bd->prepare("UPDATE tiempos SET socio_id = ?, pista_id = ?, tiempo = ?, fecha = ? WHERE id = ?");
        $consulta->bind_param("iissi", $socio_id, $pista_id, $tiempo, $fecha, $id);

        if ($consulta->execute()) {
            echo "Tiempo actualizado exitosamente";
        } else {
            echo "Error al actualizar: " . $consulta->error;
        }

        $consulta->close();
    }

    // Eliminar tiempo
    public function eliminar_tiempo($id) {
        $consulta = $this->bd->prepare("DELETE FROM tiempos WHERE id = ?");
        $consulta->bind_param("i", $id);

        if ($consulta->execute()) {
            echo "Tiempo eliminado exitosamente";
        } else {
            echo "Error al eliminar: " . $consulta->error;
        }

        $consulta->close();
    }

    // Obtener todos los tiempos
    public function obtener_tiempos() {
        $consulta = $this->bd->prepare("SELECT * FROM tiempos");
        $consulta->execute();
        $resultados = $consulta->get_result();

        if ($resultados === false) {
            echo "Error al obtener los resultados: " . $consulta->error;
            return [];
        }

        if ($resultados->num_rows > 0) {
            return $resultados->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function obtener_tiempos_con_nombres() {
        $consulta = $this->bd->prepare("
            SELECT tiempos.id, 
                   socios.nombre_usuario AS nombre_socio, 
                   pistas.nombre AS nombre_pista, 
                   tiempos.tiempo, 
                   tiempos.fecha 
            FROM tiempos
            JOIN socios ON tiempos.socio_id = socios.id
            JOIN pistas ON tiempos.pista_id = pistas.id
        ");
        $consulta->execute();
        $resultados = $consulta->get_result();
    
        if ($resultados === false) {
            echo "Error al obtener los resultados: " . $consulta->error;
            return [];
        }
    
        return $resultados->fetch_all(MYSQLI_ASSOC);
    }
    
    public function obtener_socios() {
        $consulta = $this->bd->prepare("SELECT id, nombre_usuario FROM socios");
        $consulta->execute();
        $resultados = $consulta->get_result();
    
        return $resultados->fetch_all(MYSQLI_ASSOC);
    }
    
    public function obtener_pistas() {
        $consulta = $this->bd->prepare("SELECT id, nombre FROM pistas");
        $consulta->execute();
        $resultados = $consulta->get_result();
    
        return $resultados->fetch_all(MYSQLI_ASSOC);
    } 
    
    // Buscar tiempos por nombre de socio
    public function buscar_tiempos_por_nombre_socio($nombre_socio) {
        $consulta = $this->bd->prepare("
            SELECT 
                tiempos.id, 
                socios.nombre_usuario AS nombre_socio, 
                pistas.nombre AS nombre_pista, 
                tiempos.tiempo, 
                tiempos.fecha
            FROM tiempos
            INNER JOIN socios ON tiempos.socio_id = socios.id
            INNER JOIN pistas ON tiempos.pista_id = pistas.id
            WHERE socios.nombre_usuario LIKE ?
        ");
        $nombre_socio_like = "%" . $nombre_socio . "%";
        $consulta->bind_param("s", $nombre_socio_like);
        $consulta->execute();
        $resultados = $consulta->get_result();

        if ($resultados === false) {
            echo "Error al obtener los resultados: " . $consulta->error;
            return [];
        }

        return $resultados->fetch_all(MYSQLI_ASSOC);
    }
}
?>
