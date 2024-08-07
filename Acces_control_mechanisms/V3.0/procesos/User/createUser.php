<?php
require_once "../../clases/User.php";

// Obtener los datos del POST en formato de array
$nombre = $_POST['name'];
$password = $_POST['password'];

// Verificar si se recibieron el nombre y la contraseña
if (!empty($nombre) && !empty($password)) {
    $datos = [
        'name' => $nombre,
        'password' => $password
    ];

    $users = new User();
    $resultado = $users->createUser($datos);
    echo json_encode(['success' => $resultado]);
} else {
    echo json_encode(['error' => 'El nombre o la contraseña están vacíos']);
}
?>
