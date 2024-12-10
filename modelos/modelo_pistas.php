<?php
require '../bd/bd.php';

class modelo_pistas{
    private $bd;
    
    public function __construct(){
        $this->bd = conectar::conexion();
    }

    // Insertar nueva pista
    public function insertar_pista($nombre, $descripcion) {
        $consulta = $this->bd->prepare("INSERT INTO pistas (nombre, descripcion) VALUES (?, ?)");
        $consulta->bind_param("ss", $nombre, $descripcion);

        if ($consulta->execute()) {
            echo "Pista registrada exitosamente";
        } else {
            echo "Error al ejecutar: " . $consulta->error;
        }

        $consulta->close();
    }

    // Buscar pista por nombre
    public function buscar_pista($nombre) {
        $consulta = $this->bd->prepare("SELECT * FROM pistas WHERE nombre = ?");
        if ($consulta === false) {
            echo "Error en la preparación de la consulta: " . $this->bd->error;
            return [];
        }
        $consulta->bind_param("s", $nombre);
        $consulta->execute();
        $resultados = $consulta->get_result();
        if ($resultados === false) {
            echo "Error al obtener los resultados: " . $consulta->error;
            return [];
        }
        
        // Verifica si encontró alguna pista
        if ($resultados->num_rows > 0) {
            return $resultados->fetch_all(MYSQLI_ASSOC);  // Devuelve un array asociativo
        } else {
            return [];  // Devuelve un array vacío si no se encuentra la pista
        }
    }

    // Actualizar pista
    public function actualizar_pista($id, $nombre, $descripcion) {
        // Prepara la consulta SQL para actualizar la información de la pista
        $consulta = $this->bd->prepare("UPDATE pistas SET nombre = ?, descripcion = ? WHERE id = ?");
        $consulta->bind_param("ssi", $nombre, $descripcion, $id);

        if ($consulta->execute()) {
            echo "Pista actualizada exitosamente";
        } else {
            echo "Error al actualizar: " . $consulta->error;
        }

        $consulta->close();
    }

    // Eliminar pista
    public function eliminar_pista($id) {
        // Prepara la consulta SQL para eliminar la pista por su ID
        $consulta = $this->bd->prepare("DELETE FROM pistas WHERE id = ?");
        $consulta->bind_param("i", $id);

        if ($consulta->execute()) {
            echo "Pista eliminada exitosamente";
        } else {
            echo "Error al eliminar: " . $consulta->error;
        }

        $consulta->close();
    }

    // Obtener todas las pistas
    public function obtener_pistas() {
        $consulta = $this->bd->prepare("SELECT * FROM pistas");
        $consulta->execute();
        $resultados = $consulta->get_result();

        if ($resultados === false) {
            echo "Error al obtener los resultados: " . $consulta->error;
            return [];
        }

        // Verifica si hay resultados
        if ($resultados->num_rows > 0) {
            return $resultados->fetch_all(MYSQLI_ASSOC);  // Devuelve un array asociativo
        } else {
            return [];  // Devuelve un array vacío si no hay pistas
        }
    }

    // Buscar pista por ID
    public function buscar_pista_por_id($id) {
        // Prepara la consulta SQL para buscar la pista por ID
        $consulta = $this->bd->prepare("SELECT * FROM pistas WHERE id = ?");
        if ($consulta === false) {
            echo "Error en la preparación de la consulta: " . $this->bd->error;
            return null;
        }

        $consulta->bind_param("i", $id);
        $consulta->execute();
        $resultado = $consulta->get_result();

        if ($resultado === false) {
            echo "Error al obtener los resultados: " . $consulta->error;
            return null;
        }

        // Si hay resultados, devuelve el primer registro
        if ($resultado->num_rows > 0) {
            return $resultado->fetch_assoc(); // Devuelve un array asociativo de una única fila
        } else {
            return null; // No se encontró la pista
        }
    }

}
?>
