<?php 
// Incluir el archivo de conexión a la base de datos
require_once "Connection.php";

// Definición de la clase Contactos que hereda de la clase Conexion
class Action extends Connection {

    // Método para obtener todos los contactos (usuarios) de la base de datos
    public function getAllActions() {
        // Establecer la conexión a la base de datos
        $conexion = $this->connect();
    
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
    public function createAction($datos) {
        // Establecer la conexión a la base de datos
        $conexion = Connection::connect();
    
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
    public function getActionByID($ID) {
        // Establecer la conexión a la base de datos
        $conexion = Connection::connect();

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

    public function deleteAction($idAction)
    {
        // Establecer la conexión a la base de datos
        $conexion = Connection::connect();

        // Consulta para verificar si la accion está siendo utilizada en team_action
        $sqlCheckDependencies = "SELECT COUNT(*) AS count FROM team_action WHERE ID_Action = ?";
        $queryCheckDependencies = $conexion->prepare($sqlCheckDependencies);
        $queryCheckDependencies->bind_param('i', $idAction);
        $queryCheckDependencies->execute();
        $result = $queryCheckDependencies->get_result();
        $row = $result->fetch_assoc();

        // Verificar si hay dependencias en team_action
        if ($row['count'] > 0) {
            // Hay dependencias activas en team_action, no se puede eliminar el usuario
            return false;
        } else {
            // No hay dependencias activas, proceder con la eliminación del usuario

            // Desactivar temporalmente las restricciones de clave externa
            $conexion->query('SET FOREIGN_KEY_CHECKS = 0');

            // Eliminar el registro de la tabla principal
            $sqlDeleteAction = "DELETE FROM action WHERE ID = ?";
            $queryDeleteAction = $conexion->prepare($sqlDeleteAction);
            $queryDeleteAction->bind_param('i', $idAction);
            $respuesta = $queryDeleteAction->execute();

            // Volver a activar las restricciones de clave externa
            $conexion->query('SET FOREIGN_KEY_CHECKS = 1');

            return $respuesta;
        }
    }

    public function editAction($ID, $newName)
    {
        // Establecer la conexión a la base de datos
        $conexion = Connection::connect();
    
        // Preparar la consulta para actualizar el nombre del usuario
        $sql = "UPDATE action SET name = ? WHERE ID = ?";
        $query = $conexion->prepare($sql);
        $query->bind_param('si', $newName, $ID);
        
        // Ejecutar la consulta y obtener el resultado
        $respuesta = $query->execute();
        return $respuesta;
    }

}
?>
