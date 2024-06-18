<?php
require_once "../../clases/User.php";

// Obtener el ID del grupo a eliminar desde los parámetros POST
$idAction = $_POST['id']; // Asegúrate de que este sea el nombre correcto del campo en tu formulario HTML

// Verificar si se proporcionó un ID válido
if (isset($idAction) && !empty($idAction)) {
    // Crear una instancia de la clase Team
    $teamActionLinkInstance = new User();

    // Llamar al método deleteTeam() y pasarle el ID del grupo
    $resultado = $teamActionLinkInstance->deleteUser($idAction);

    // Verificar si la eliminación fue exitosa o no
    if ($resultado === true) {
        echo json_encode('Usuario eliminado con exito'); // Envía un éxito si la eliminación fue exitosa
    } else {
        echo json_encode('No se pudo eliminar el usuario debido a dependencias.');
    }
} else {
    // Devolver un mensaje de error si no se proporcionó un ID válido
    echo json_encode(['success' => false, 'error' => 'No se proporcionó un ID de Grupo válido.']);
}
?>
