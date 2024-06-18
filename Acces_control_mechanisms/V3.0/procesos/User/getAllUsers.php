<?php 

	require_once "../../clases/User.php";
	// Instanciar la clase Contactos
	$teamActionLinkInstance = new User();
	
	// Obtener todos los usuarios
	$actionList = $teamActionLinkInstance->getAllUsers();

	// Devolver los datos en formato JSON
	echo json_encode($actionList);

?>
