<?php
require '../bd/bd.php';

class modelo_precios {
    private $bd;

    public function __construct() {
        $this->bd = conectar::conexion();
    }

    // Insertar nuevo precio
    public function insertar_precio($pista_id, $duracion_minutos, $precio) {
        // Prepara la consulta SQL para insertar el nuevo precio
        $consulta = $this->bd->prepare("INSERT INTO precios (pista_id, duracion_minutos, precio) VALUES (?, ?, ?)");
        $consulta->bind_param("iid", $pista_id, $duracion_minutos, $precio);  // 'i' para entero, 'd' para decimal

        if ($consulta->execute()) {
            echo "Precio registrado exitosamente";
        } else {
            echo "Error al ejecutar: " . $consulta->error;
        }

        $consulta->close();
    }

    // Buscar precio por ID
    public function buscar_precio($id) {
        $consulta = $this->bd->prepare("SELECT * FROM precios WHERE id = ?");
        $consulta->bind_param("i", $id);
        $consulta->execute();
        $resultados = $consulta->get_result();

        if ($resultados === false) {
            echo "Error al obtener los resultados: " . $consulta->error;
            return [];
        }

        // Verifica si encontró algún precio
        if ($resultados->num_rows > 0) {
            return $resultados->fetch_all(MYSQLI_ASSOC);  // Devuelve un array asociativo
        } else {
            return [];  // Devuelve un array vacío si no se encuentra el precio
        }
    }

    // Buscar precios por pista
    public function buscar_precios_por_pista($pista_nombre) {
        $consulta = $this->bd->prepare(
            "SELECT precios.id, pistas.nombre AS nombre_pista, precios.duracion_minutos, precios.precio 
             FROM precios 
             INNER JOIN pistas ON precios.pista_id = pistas.id 
             WHERE pistas.nombre LIKE ?"
        );
        $pista_nombre = "%" . $pista_nombre . "%";
        $consulta->bind_param("s", $pista_nombre);
        $consulta->execute();
        $resultados = $consulta->get_result();
    
        if ($resultados === false) {
            echo "Error al obtener los resultados: " . $consulta->error;
            return [];
        }
    
        return $resultados->fetch_all(MYSQLI_ASSOC);
    }
    
    // Actualizar precio
    public function actualizar_precio($id, $pista_id, $duracion_minutos, $precio) {
        // Prepara la consulta SQL para actualizar el precio
        $consulta = $this->bd->prepare("UPDATE precios SET pista_id = ?, duracion_minutos = ?, precio = ? WHERE id = ?");
        $consulta->bind_param("iidi", $pista_id, $duracion_minutos, $precio, $id);  // 'i' para entero, 'd' para decimal

        if ($consulta->execute()) {
            echo "Precio actualizado exitosamente";
        } else {
            echo "Error al actualizar: " . $consulta->error;
        }

        $consulta->close();
    }

    // Eliminar precio
    public function eliminar_precio($id) {
        // Prepara la consulta SQL para eliminar el precio por su ID
        $consulta = $this->bd->prepare("DELETE FROM precios WHERE id = ?");
        $consulta->bind_param("i", $id);

        if ($consulta->execute()) {
            echo "Precio eliminado exitosamente";
        } else {
            echo "Error al eliminar: " . $consulta->error;
        }

        $consulta->close();
    }

    // Obtener todos los precios
    public function obtener_precios() {
        $consulta = $this->bd->prepare("
            SELECT precios.id, pistas.nombre AS nombre_pista, precios.duracion_minutos, precios.precio
            FROM precios
            JOIN pistas ON precios.pista_id = pistas.id
        ");
        $consulta->execute();
        $resultados = $consulta->get_result();
    
        if ($resultados === false) {
            echo "Error al obtener los resultados: " . $consulta->error;
            return [];
        }
    
        if ($resultados->num_rows > 0) {
            return $resultados->fetch_all(MYSQLI_ASSOC);  // Devuelve un array asociativo
        } else {
            return [];  // Devuelve un array vacío si no hay precios
        }
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

        return $resultados->fetch_all(MYSQLI_ASSOC);  // Devuelve un array asociativo
    }
}
?>

