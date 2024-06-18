<?php
require_once "../../clases/Action.php";

// Obtener el ID del grupo a editar desde los parámetros POST
$idAction = $_POST['id'];
$nameAction = $_POST['newName'];

// Verificar si se proporcionó un ID válido
if (isset($idAction) && !empty($idAction)) {
    // Crear una instancia de la clase User
    $teamActionLinkInstance = new Action();

    // Llamar al método deleteUser() y pasarle el ID del grupo
    $resultado = $teamActionLinkInstance->editAction($idAction, $nameAction);

    // Verificar si la eliminación fue exitosa o no
    if ($resultado === true) {
        echo json_encode('Accion editado con exito'); // Envía un éxito si la eliminación fue exitosa
    } else {
        echo json_encode('No se pudo editar la accion.');
    }
} else {
    // Devolver un mensaje de error si no se proporcionó un ID válido
    echo json_encode(['success' => false, 'error' => 'No se proporcionó un ID de Grupo válido.']);
}
?>
