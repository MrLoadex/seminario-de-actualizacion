<?php 

	require_once "../../clases/Users.php";

	// Instanciar la clase Contactos
	$actionInstance = new Users();
	
	// Obtener todos los usuarios
	$usersList = $actionInstance->getAllUsers();

	// Devolver los datos en formato JSON
	echo json_encode($usersList);

?>
