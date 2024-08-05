<?php 

	require_once "../../clases/Team.php";

	// Instanciar la clase Contactos
	$teamActionLinkInstance = new Team();
	
	// Obtener todos los usuarios
	$teamsList = $teamActionLinkInstance->getAllTeams();

	// Devolver los datos en formato JSON
	echo json_encode($teamsList);

?>
