<?php 
// Incluir el archivo de conexión a la base de datos
require_once "Connection.php";

// Definición de la clase Contactos que hereda de la clase Conexion
class User extends Connection {

    // Método para obtener todos los contactos (usuarios) de la base de datos
    public function getAllUsers() 
    {
        // Establecer la conexión a la base de datos
        $connection = $this->connect();
    
        // Definir la consulta SQL para obtener todos los registros de la tabla `user`
        $sql = "CALL get_all_users";
        // Ejecutar la consulta
        $result = $connection->query($sql);
    
        // Inicializar un array para almacenar los resultados
        $users = array();
        // Recorrer los resultados y agregarlos al array $usuarios
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    
        // Devolver el array de usuarios
        return $users;
    }

    // Método para agregar un nuevo contacto (usuario) a la base de datos
    public function createUser($datos) {
        
        $patron ="/^[a-zA-Z]\w{3,14}$/";
        if (!preg_match($patron, $datos["password"]))
        {
            return "Contraseña no válida";
        }

        $conexion = Connection::connect();
        $sql = "CALL create_user(?, ?)";
        $query = $conexion->prepare($sql);
        $query->bind_param('ss', $datos['name'], $datos['password']);
        $respuesta = $query->execute();
        return $respuesta;
    }


    public function deleteUser($idUser)
    {
        $conexion = Connection::connect();

        // Consulta para verificar si el usuario está siendo utilizado en user_team
        $sqlCheckDependencies = "SELECT COUNT(*) AS count FROM user_team WHERE ID_user = ?";
        $queryCheckDependencies = $conexion->prepare($sqlCheckDependencies);
        $queryCheckDependencies->bind_param('i', $idUser);
        $queryCheckDependencies->execute();
        $result = $queryCheckDependencies->get_result();
        $row = $result->fetch_assoc();

        // Verificar si hay dependencias en user_team
        if ($row['count'] > 0) {
            // Hay dependencias activas en user_team, no se puede eliminar el usuario
            return false;
        } else {
            // No hay dependencias activas, proceder con la eliminación del usuario

            // Desactivar temporalmente las restricciones de clave externa
            $conexion->query('SET FOREIGN_KEY_CHECKS = 0');

            // Eliminar el registro de la tabla principal
            $sqlDeleteUser = "CALL delete_user(?)";
            $queryDeleteUser = $conexion->prepare($sqlDeleteUser);
            $queryDeleteUser->bind_param('i', $idUser);
            $respuesta = $queryDeleteUser->execute();

            // Volver a activar las restricciones de clave externa
            $conexion->query('SET FOREIGN_KEY_CHECKS = 1');

            return $respuesta;
        }
    }

    public function editUser($ID, $newName)
    {
        // Establecer la conexión a la base de datos
        $conexion = Connection::connect();
        $sql = "CALL update_user(?, ?)";
        $query = $conexion->prepare($sql);
        $query->bind_param('si', $newName, $ID);
        $respuesta = $query->execute();
        return $respuesta;
    }

    // Método para obtener los datos de un contacto (usuario) por ID
    public function getUserById($ID) {
       
        $conexion = Connection::connect();
        $sql = "CALL get_username_by_id(?)";
        $query = $conexion->prepare($sql);
        $query->bind_param('i', $ID);
        $query->execute();
        $result = $query->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }
    
    public function checkUserAndPass($user, $password)
    {
        $conexion = Connection::connect();
        $sql = "CALL check_user_and_password(?, ?)";
        $query = $conexion->prepare($sql);
        $query->bind_param('ss', $user, $password);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserIDByName($p_name) {

        $conexion = Connection::connect();
        $sql = "CALL get_userID_by_name(?)";
        $query = $conexion->prepare($sql);
        $query->bind_param('s', $p_name);
        $query->execute();
        $result = $query->get_result();
        $userID = $result->fetch_assoc();

        // Devolver los datos del contacto
        return $userID;
    }
    
}
?>
