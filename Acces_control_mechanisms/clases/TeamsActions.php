<?php 
// Incluir el archivo de conexión a la base de datos
require_once "Connection.php";

// Definición de la clase TeamsActions que hereda de la clase Conexion
class TeamsActions extends Connection {

    // Método para obtener todos los contactos (usuarios) de la base de datos
    public function getAllTeamsActions() {
        // Establecer la conexión a la base de datos
        $conexion = $this->conncet();
    
        // Definir la consulta SQL para obtener todos los registros de la tabla `team_action`
        $sql = "SELECT * FROM `team_action`";
        // Ejecutar la consulta
        $result = $conexion->query($sql);
    
        // Inicializar un array para almacenar los resultados
        $TeamsActions = array();
        // Recorrer los resultados y agregarlos al array $TeamsActions
        while ($row = $result->fetch_assoc()) {
            $TeamsActions[] = $row;
        }
    
        // Devolver el array de TeamsActions
        return $TeamsActions;
    }

    // Método para agregar un nuevo vínculo entre equipo y acción a la base de datos
    public function addTeamActionLink($datos) {
        // Establecer la conexión a la base de datos
        $conexion = Connection::conncet();
    
        // Definir la consulta SQL para insertar un nuevo registro en la tabla `team_action`
        $sql = "INSERT INTO `team_action` (ID_team, ID_action) VALUES (?, ?)";
        // Preparar la consulta
        $query = $conexion->prepare($sql);
        // Enlazar los parámetros con los valores proporcionados
        // 'ii' indica que estamos enlazando dos variables de tipo int
        $query->bind_param('ii', $datos['ID_team'], $datos['ID_action']);
        // Ejecutar la consulta
        $respuesta = $query->execute();
        // Devolver la respuesta de la ejecución (true o false)
        return $respuesta;
    }

}
?>
