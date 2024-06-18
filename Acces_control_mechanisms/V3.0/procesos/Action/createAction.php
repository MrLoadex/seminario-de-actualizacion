<?php
// Incluir la clase Users
require_once "../../clases/Action.php";

// Obtener los datos del POST en formato de array
$nombre = $_POST['name']; // Obtener el nombre del formulario

// Verificar si se recibió el nombre
if (!empty($nombre)) {
    // Crear un array asociativo con los datos recibidos
    $datos = [
        'name' => $nombre
    ];

    // Crear una instancia de la clase Users
    $actions = new Action();

    // Llamar al método createUser() y pasarle los datos
    $resultado = $actions->createAction($datos);

    // Devolver el resultado de la inserción como JSON
    echo json_encode(['success' => $resultado]);
} else {
    // Devolver un mensaje de error si el nombre está vacío
    echo json_encode(['error' => 'El nombre está vacío']);
}
?>
