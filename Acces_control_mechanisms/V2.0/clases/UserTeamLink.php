<?php 
// Incluir el archivo de conexión a la base de datos
require_once "Connection.php";

// Definición de la clase TeamsActions que hereda de la clase Conexion
class UsersTeamLink extends Connection {

    // Método para obtener todos los contactos (usuarios) de la base de datos
    public function getAllUsersTeams() {
        // Establecer la conexión a la base de datos
        $conexion = $this->connect();
    
        // Definir la consulta SQL para obtener todos los registros de la tabla `team_action`
        $sql = "SELECT * FROM `user_team`";
        // Ejecutar la consulta
        $result = $conexion->query($sql);
    
        // Inicializar un array para almacenar los resultados
        $usersTeams = array();
        // Recorrer los resultados y agregarlos al array $TeamsActions
        while ($row = $result->fetch_assoc()) {
            $usersTeams[] = $row;
        }
    
        // Devolver el array de TeamsActions
        return $usersTeams;
    }

    // Método para agregar un nuevo vínculo entre usuario y equipo a la base de datos
    public function createUserTeamLink($datos) {
        // Establecer la conexión a la base de datos
        $conexion = Connection::connect();
    
        // Definir la consulta SQL para insertar un nuevo registro en la tabla `team_action`
        $sql = "INSERT INTO `user_team` (ID_user, ID_team) VALUES (?, ?)";
        // Preparar la consulta
        $query = $conexion->prepare($sql);
        // Enlazar los parámetros con los valores proporcionados
        // 'ii' indica que estamos enlazando dos variables de tipo int
        $query->bind_param('ii', $datos['ID_user'], $datos['ID_team']);
        // Ejecutar la consulta
        $respuesta = $query->execute();
        // Devolver la respuesta de la ejecución (true o false)
        return $respuesta;
    }

    public function deleteUserTeamLink($idUser, $idTeam) {
        // Establecer la conexión a la base de datos
        $conexion = Connection::connect();
    
        // SQL para eliminar una fila en user_team que coincida con ambos IDs
        $sql = "DELETE FROM user_team WHERE ID_user = ? AND ID_team = ?";
        $query = $conexion->prepare($sql);
    
        // Enlazar los parámetros ID_user e ID_team
        $query->bind_param('ii', $idUser, $idTeam);
    
        // Ejecutar la consulta y obtener la respuesta
        $respuesta = $query->execute();
    
        return $respuesta;
    }
    
}
?>
