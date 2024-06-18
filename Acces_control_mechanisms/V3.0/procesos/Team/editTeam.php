<?php
require_once "../../clases/Team.php";

// Obtener el ID del grupo a editar desde los parámetros POST
$idAction = $_POST['id'];
$nameTeam = $_POST['newName'];

// Verificar si se proporcionó un ID válido
if (isset($idAction) && !empty($idAction)) {
    // Crear una instancia de la clase Team
    $teamActionLinkInstance = new Team();

    // Llamar al método deleteTeam() y pasarle el ID del grupo
    $resultado = $teamActionLinkInstance->editTeam($idAction, $nameTeam);

    // Verificar si la eliminación fue exitosa o no
    if ($resultado === true) {
        echo json_encode('Equipo editado con exito'); // Envía un éxito si la eliminación fue exitosa
    } else {
        echo json_encode('No se pudo editar el equipo.');
    }
} else {
    // Devolver un mensaje de error si no se proporcionó un ID válido
    echo json_encode(['success' => false, 'error' => 'No se proporcionó un ID de Grupo válido.']);
}
?>
