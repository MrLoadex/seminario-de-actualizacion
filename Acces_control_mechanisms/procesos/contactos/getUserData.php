<?php 
	require_once "../../clases/Users.php";

	// Obtener el ID del contacto a buscar de la URL
	$ID = $_GET['id'];

	// Verificar si se proporcionó un ID de contacto válido
	if(isset($ID) && !empty($ID)) {
		// Crear una instancia de la clase Contactos
		$actionInstance = new Users();

		// Obtener los datos del contacto
		$action = $actionInstance->getUserName($ID);

		// Devolver los datos del contacto como JSON
		echo json_encode($action);
	} else {
		// Devolver un mensaje de error si no se proporcionó un ID válido
		echo json_encode(array('error' => 'No se proporcionó un ID de contacto válido.'));
	}
?>
