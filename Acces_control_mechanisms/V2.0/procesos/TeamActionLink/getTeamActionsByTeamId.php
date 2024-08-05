<?php 
	require_once "../../clases/TeamActionLink.php";

	// Obtener el ID del contacto a buscar de la URL
	$ID = $_GET['teamId'];

	// Verificar si se proporcionó un ID de contacto válido
	if(isset($ID) && !empty($ID)) {
		// Crear una instancia de la clase Contactos
		$teamActionLinkInstance = new TeamActionLink();

		// Obtener los datos del contacto
		$teamActionLinks = $teamActionLinkInstance->getTeamActionsByTeamId($ID);

		// Devolver los datos del contacto como JSON
		echo json_encode($teamActionLinks);
	} else {
		// Devolver un mensaje de error si no se proporcionó un ID válido
		echo json_encode(array('error' => 'No se proporcionó un ID de contacto válido.'));
	}
?>
