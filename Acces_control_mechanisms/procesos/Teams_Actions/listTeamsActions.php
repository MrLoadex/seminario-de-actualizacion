<?php 

	require_once "../../clases/TeamsActions.php";

	// Instanciar la clase Contactos
	$teamActionsInstance = new TeamsActions();
	
	// Obtener todos los usuarios
	$teamActionsList = $teamActionsInstance->getAllTeamsActions();

	// Devolver los datos en formato JSON
	echo json_encode($teamActionsList);

?>
