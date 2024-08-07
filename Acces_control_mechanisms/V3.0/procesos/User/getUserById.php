<?php 
	require_once "../../clases/User.php";

	// Obtener el ID del contacto a buscar de la URL
	$ID = $_GET['id'];

	// Verificar si se proporcionó un ID de contacto válido
	if(isset($ID) && !empty($ID)) {
		$userInstance = new User();
		$acces = $userInstance->getUserById($ID);
		echo json_encode($acces);
	} else {
		// Devolver un mensaje de error si no se proporcionó un ID válido
		echo json_encode(array('error' => 'No se proporcionó un ID de contacto válido.'));
	}
?>
