<?php 
require_once "Conexion.php";

class Contactos extends Conexion {
    public function obtenerTodosLosContactos() {
        $conexion = $this->conectar();
    
        $sql = "SELECT * FROM usuarios";
        $result = $conexion->query($sql);
    
        $usuarios = array();
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
    
        return $usuarios;
    }

    public function agregarContacto($datos) {
        $conexion = Conexion::conectar();
    
        $sql = "INSERT INTO usuarios (userName, saldo)
                VALUES (?, ?)";
        $query = $conexion->prepare($sql);
        
        // Aquí, 'ss' indica que estás enlazando dos variables de tipo string
        $query->bind_param('ss', $datos['userName'], $datos['saldo']);
        
        $respuesta = $query->execute();
        return $respuesta;
    }
    
    public function eliminarContacto($ID) {
        $conexion = Conexion::conectar();
    
        $sql = "DELETE FROM usuarios WHERE ID = ?";
        $query = $conexion->prepare($sql);
        $query->bind_param('i', $ID);
        $respuesta = $query->execute();
        return $respuesta;
    }    

    public function obtenerDatosContacto($ID) {
        $conexion = Conexion::conectar();

        $sql = "SELECT ID, userName, saldo  
                FROM usuarios 
                WHERE ID = ?";
        $query = $conexion->prepare($sql);
        $query->bind_param('i', $ID);
        $query->execute();
        $result = $query->get_result();
        
        $contacto = $result->fetch_assoc();

        $datos = array(
                    "ID" => $contacto['ID'],
                    "userName" => $contacto['userName'],
                    "saldo" => $contacto['saldo'],
                        );
        return $datos;
    }

    public function actualizarContacto($datos) {
        $conexion = Conexion::conectar();
    
        $sql = "UPDATE usuarios SET userName = ?, saldo = ? WHERE ID = ?";
        $query = $conexion->prepare($sql);
        $query->bind_param('ssi', $datos['userName'], $datos['saldo'], $datos['ID']);
        $respuesta = $query->execute();
        return $respuesta;
    }
    
}

?>
