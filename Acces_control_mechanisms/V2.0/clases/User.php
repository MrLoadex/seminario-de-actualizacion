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
        $sql = "SELECT * FROM `user`";
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
        // Establecer la conexión a la base de datos
        $conexion = Connection::connect();
    
        // Definir la consulta SQL para insertar un nuevo registro en la tabla `user`
        $sql = "INSERT INTO `user` (name) VALUES (?)";
        // Preparar la consulta
        $query = $conexion->prepare($sql);
        
        // Enlazar los parámetros con los valores proporcionados
        // 'ss' indica que estamos enlazando dos variables de tipo string
        $query->bind_param('s', $datos['name']);
        
        // Ejecutar la consulta
        $respuesta = $query->execute();
        // Devolver la respuesta de la ejecución (true o false)
        return $respuesta;
    }

    public function deleteUser($idUser)
    {
        // Establecer la conexión a la base de datos
        $conexion = Connection::connect();

        // Consulta para verificar si el usuario está siendo utilizado en user_team
        $sqlCheckDependencies = "SELECT COUNT(*) AS count FROM user_team WHERE ID_user = ?";
        $queryCheckDependencies = $conexion->prepare($sqlCheckDependencies);
        $queryCheckDependencies->bind_param('i', $idUser); // Usar $idUser en lugar de $ID
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
            $sqlDeleteUser = "DELETE FROM user WHERE ID = ?";
            $queryDeleteUser = $conexion->prepare($sqlDeleteUser);
            $queryDeleteUser->bind_param('i', $idUser); // Usar $idUser en lugar de $ID
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
    
        // Preparar la consulta para actualizar el nombre del usuario
        $sql = "UPDATE user SET name = ? WHERE ID = ?";
        $query = $conexion->prepare($sql);
        $query->bind_param('si', $newName, $ID);
        
        // Ejecutar la consulta y obtener el resultado
        $respuesta = $query->execute();
        return $respuesta;
    }

    // Método para obtener los datos de un contacto (usuario) por ID
    public function getUserById($ID) {
        // Establecer la conexión a la base de datos
        $conexion = Connection::connect();

        // Definir la consulta SQL para obtener un registro de la tabla `user` por ID
        $sql = "SELECT ID, name FROM `user` WHERE ID = ?";
        // Preparar la consulta
        $query = $conexion->prepare($sql);
        // Enlazar el parámetro ID con el valor proporcionado
        $query->bind_param('i', $ID);
        // Ejecutar la consulta
        $query->execute();
        // Obtener el resultado de la consulta
        $result = $query->get_result();
        
        // Obtener los datos del contacto en un array asociativo
        $user = $result->fetch_assoc();

        // Devolver los datos del contacto
        return $user;
    }  
}
?>
