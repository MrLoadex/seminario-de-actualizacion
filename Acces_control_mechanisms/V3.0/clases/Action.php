<?php 
// Incluir el archivo de conexión a la base de datos
require_once "Connection.php";

// Definición de la clase Contactos que hereda de la clase Conexion
class Action extends Connection {

    // Método para obtener todos los contactos (usuarios) de la base de datos
    public function getAllActions() {

        $conexion = $this->connect();
        $sql = "SELECT * FROM `action`";
        $result = $conexion->query($sql);
        $Actions = array();
        while ($row = $result->fetch_assoc()) {
            $Actions[] = $row;
        }
    
        // Devolver el array de usuarios
        return $Actions;
    }
    // Método para agregar un nuevo contacto (usuario) a la base de datos
    public function createAction($datos) {
        
        $conexion = Connection::connect();
        $sql = "INSERT INTO `action` (name) VALUES (?)";
        $query = $conexion->prepare($sql);
        $query->bind_param('s', $datos['name']);
        $respuesta = $query->execute();
        return $respuesta;
    } 
    // Método para obtener los datos de un contacto (usuario) por ID
    public function getActionByID($ID) {
        
        $conexion = Connection::connect();
        $sql = "SELECT ID, name FROM `action` WHERE ID = ?";
        $query = $conexion->prepare($sql);
        $query->bind_param('i', $ID);
        $query->execute();
        $result = $query->get_result();
        $action = $result->fetch_assoc();
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
