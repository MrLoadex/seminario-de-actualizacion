<?php
require_once "../../clases/User.php";
    session_start();

    // Obtener los datos del POST en formato de array
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar si se recibieron el nombre y la contraseña
    if (!empty($username) && !empty($password)) {
        $users = new User();
        $resultado = $users->checkUserAndPass($username, $password);

        // Devolver el resultado de la verificación como JSON
        if ($resultado) {
            $userId = $users->getUserIDByName($username);
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Usuario o contraseña incorrectos']);
        }
    } else {
        echo json_encode(['error' => 'El nombre o la contraseña están vacíos']);
    }
?>
