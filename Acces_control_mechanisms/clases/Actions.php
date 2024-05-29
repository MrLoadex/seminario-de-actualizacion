<?php 
// Incluir el archivo de conexión a la base de datos
require_once "Connection.php";

// Definición de la clase Contactos que hereda de la clase Conexion
class Actions extends Connection {

    // Método para obtener todos los contactos (usuarios) de la base de datos
    public function getAllActions() {
        // Establecer la conexión a la base de datos
        $conexion = $this->conncet();
    
        // Definir la consulta SQL para obtener todos los registros de la tabla `user`
        $sql = "SELECT * FROM `action`";
        // Ejecutar la consulta
        $result = $conexion->query($sql);
    
        // Inicializar un array para almacenar los resultados
        $Actions = array();
        // Recorrer los resultados y agregarlos al array $usuarios
        while ($row = $result->fetch_assoc()) {
            $Actions[] = $row;
        }
    
        // Devolver el array de usuarios
        return $Actions;
    }

    // Método para agregar un nuevo contacto (usuario) a la base de datos
    public function addAction($datos) {
        // Establecer la conexión a la base de datos
        $conexion = Connection::conncet();
    
        // Definir la consulta SQL para insertar un nuevo registro en la tabla `user`
        $sql = "INSERT INTO `action` (name) VALUES (?)";
        // Preparar la consulta
        $query = $conexion->prepare($sql);
        
        // Enlazar los parámetros con los valores proporcionados
        // 's' indica que estamos enlazando una variable de tipo string
        $query->bind_param('s', $datos['name']);
        
        // Ejecutar la consulta
        $respuesta = $query->execute();
        // Devolver la respuesta de la ejecución (true o false)
        return $respuesta;
    } 

    // Método para obtener los datos de un contacto (usuario) por ID
    public function getActionName($ID) {
        // Establecer la conexión a la base de datos
        $conexion = Connection::conncet();

        // Definir la consulta SQL para obtener un registro de la tabla `user` por ID
        $sql = "SELECT ID, name FROM `action` WHERE ID = ?";
        // Preparar la consulta
        $query = $conexion->prepare($sql);
        // Enlazar el parámetro ID con el valor proporcionado
        $query->bind_param('i', $ID);
        // Ejecutar la consulta
        $query->execute();
        // Obtener el resultado de la consulta
        $result = $query->get_result();
        
        // Obtener los datos del contacto en un array asociativo
        $action = $result->fetch_assoc();

        // Devolver los datos del contacto
        return $action;
    }
}
?>
