<?php
require '../bd/bd.php';

class modelo_socios{
    private $bd;
    private $socios;
    
    public function __construct(){
        $this->bd = conectar::conexion();
    }

    // Insertar nuevo socio
    public function insertar_socio($nombre_usuario, $contraseña, $email) {
        $fecha_registro = date("Y-m-d H:i:s"); // Genera la fecha actual en el formato adecuado
        
        $consulta = $this->bd->prepare("INSERT INTO socios (nombre_usuario, contrasena, email, fecha_registro) VALUES (?, ?, ?, ?)");
        $consulta->bind_param("ssss", $nombre_usuario, $contraseña, $email, $fecha_registro);
        
        if ($consulta->execute()) {
            echo "Registro exitoso";
        } else {
            echo "Error al ejecutar: " . $consulta->error;
        }
        
        $consulta->close();
    }

    // Buscar socio por nombre
    public function Buscar_socio($nombre){
        $consulta = $this->bd->prepare("SELECT * FROM socios WHERE nombre_usuario = ?");
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
        // Verifica si encontró algún usuario
        if ($resultados->num_rows > 0) {
            return $resultados->fetch_all(MYSQLI_ASSOC);  // Devuelve un array asociativo
        } else {
            return [];  // Devuelve un array vacío si no se encuentra el usuario
        }
    }    

    public function Buscar_socio_por_id($id) {
        $consulta = $this->bd->prepare("SELECT * FROM socios WHERE id = ?");
        $consulta->bind_param("i", $id);
        $consulta->execute();
        $resultados = $consulta->get_result();
    
        if ($resultados->num_rows > 0) {
            return $resultados->fetch_assoc(); // Devuelve un único resultado como array asociativo
        } else {
            return null; // Devuelve null si no se encuentra el socio
        }
    }
    
    // Actualizar socio
    public function actualizar_socio($id_socio, $nombre_usuario, $contraseña, $email) {
        // Prepara la consulta SQL para actualizar la información del socio
        $consulta = $this->bd->prepare("UPDATE socios SET nombre_usuario = ?, contrasena = ?, email = ? WHERE id = ?");
        $consulta->bind_param("sssi", $nombre_usuario, $contraseña, $email, $id_socio);

        if ($consulta->execute()) {
            echo "Socio actualizado exitosamente";
        } else {
            echo "Error al actualizar: " . $consulta->error;
        }

        $consulta->close();
    }

    // Eliminar socio
    public function eliminar_socio($id_socio) {
        // Prepara la consulta SQL para eliminar el socio por su ID
        $consulta = $this->bd->prepare("DELETE FROM socios WHERE id = ?");
        $consulta->bind_param("i", $id_socio);

        if ($consulta->execute()) {
            echo "Socio eliminado exitosamente";
        } else {
            echo "Error al eliminar: " . $consulta->error;
        }

        $consulta->close();
    }

    public function obtener_socios() {
        // Modificar la consulta para obtener los socios desde el id 1 en adelante
        $consulta = $this->bd->prepare("SELECT * FROM socios WHERE id >= 1");
        $consulta->execute();
        $resultados = $consulta->get_result();
    
        // Verifica si los resultados están vacíos
        if ($resultados->num_rows > 0) {
            return $resultados->fetch_all(MYSQLI_ASSOC);  // Convertir a array asociativo
        } else {
            return [];  // Si no hay resultados, retornar un array vacío
        }
    }       
}

?>
