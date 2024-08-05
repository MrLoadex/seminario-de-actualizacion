<?php
require_once "../../clases/User.php";

// Obtener el ID del grupo a editar desde los parámetros POST
$idAction = $_POST['id'];
$nameAction = $_POST['newName'];

// Verificar si se proporcionó un ID válido
if (isset($idAction) && !empty($idAction)) {
    // Crear una instancia de la clase User
    $teamActionLinkInstance = new User();

    // Llamar al método deleteUser() y pasarle el ID del grupo
    $resultado = $teamActionLinkInstance->editUser($idAction, $nameAction);

    // Verificar si la eliminación fue exitosa o no
    if ($resultado === true) {
        echo json_encode('Usuario editado con exito'); // Envía un éxito si la eliminación fue exitosa
    } else {
        echo json_encode('No se pudo editar el usuario.');
    }
} else {
    // Devolver un mensaje de error si no se proporcionó un ID válido
    echo json_encode(['success' => false, 'error' => 'No se proporcionó un ID de Grupo válido.']);
}
?>
