<?php 

	require_once "../../clases/Action.php";
	// Instanciar la clase Contactos
	$teamActionLinkInstance = new Action();
	
	// Obtener todos los usuarios
	$actionList = $teamActionLinkInstance->getAllActions();

	// Devolver los datos en formato JSON
	echo json_encode($actionList);

?>
