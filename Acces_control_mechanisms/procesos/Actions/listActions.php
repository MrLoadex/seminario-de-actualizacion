<?php 

	require_once "../../clases/Actions.php";

	// Instanciar la clase Contactos
	$actionsInstance = new Actions();
	
	// Obtener todos los usuarios
	$actionsList = $actionsInstance->getAllactions();

	// Devolver los datos en formato JSON
	echo json_encode($actionsList);

?>
