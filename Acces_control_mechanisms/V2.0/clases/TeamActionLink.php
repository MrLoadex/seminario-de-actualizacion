<?php 
    // Incluir el archivo de conexión a la base de datos
    require_once "Connection.php";

    // Definición de la clase TeamsActions que hereda de la clase Conexion
    class TeamActionLink extends Connection {

        // Método para obtener todos los contactos (usuarios) de la base de datos
        public function getAllTeamsActions() {
            // Establecer la conexión a la base de datos
            $conexion = $this->connect();
        
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
        public function createTeamActionLink($datos) {
            // Establecer la conexión a la base de datos
            $conexion = Connection::connect();
        
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

        public function deleteTeamActionLink($idTeam, $idAction) {
            // Establecer la conexión a la base de datos
            $conexion = Connection::connect();
        
            // SQL para eliminar una fila en user_team que coincida con ambos IDs
            $sql = "DELETE FROM team_action WHERE ID_team = ? AND ID_action = ?";
            $query = $conexion->prepare($sql);
        
            // Enlazar los parámetros ID_user e ID_team
            $query->bind_param('ii', $idTeam, $idAction);
        
            // Ejecutar la consulta y obtener la respuesta
            $respuesta = $query->execute();
        
            return $respuesta;
        }

        public function getTeamActionsByTeamId($idTeam) {
            // Establecer la conexión a la base de datos
            $conexion = Connection::connect();
        
            // Definir la consulta SQL para obtener todas las acciones asociadas a un equipo específico
            $sql = "SELECT * FROM `team_action` WHERE ID_team = ?";
            
            // Preparar la consulta
            $query = $conexion->prepare($sql);
            
            // Enlazar el parámetro ID_team
            $query->bind_param('i', $idTeam);
            
            // Ejecutar la consulta
            $query->execute();
            
            // Obtener los resultados
            $result = $query->get_result();
            
            // Inicializar un array para almacenar los resultados
            $teamActions = array();
            
            // Recorrer los resultados y agregarlos al array $teamActions
            while ($row = $result->fetch_assoc()) {
                $teamActions[] = $row;
            }
            
            // Devolver el array de teamActions
            return $teamActions;
        }
        
    }
?>
