<?php
require_once "../../clases/Action.php";

// Obtener el ID del grupo a eliminar desde los parámetros POST
$idAction = $_POST['id'];

// Verificar si se proporcionó un ID válido
if (isset($idAction) && !empty($idAction)) {
    // Crear una instancia de la clase Action
    $teamActionLinkInstance = new Action();

    // Llamar al método deleteAction() y pasarle el ID del grupo
    $resultado = $teamActionLinkInstance->deleteAction($idAction);

    // Verificar si la eliminación fue exitosa o no
    if ($resultado === true) {
        echo json_encode('Accion eliminado con exito'); // Envía un éxito si la eliminación fue exitosa
    } else {
        echo json_encode('No se pudo eliminar el accion debido a dependencias.');
    }
} else {
    // Devolver un mensaje de error si no se proporcionó un ID válido
    echo json_encode(['success' => false, 'error' => 'No se proporcionó un ID de Grupo válido.']);
}
?>
