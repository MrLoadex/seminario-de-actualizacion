<?php 

	require_once "../../clases/Teams.php";

	// Instanciar la clase Contactos
	$actionInstance = new Teams();
	
	// Obtener todos los usuarios
	$teamsList = $actionInstance->getAllteams();

	// Devolver los datos en formato JSON
	echo json_encode($teamsList);

?>
