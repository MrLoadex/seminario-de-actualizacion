<?php 
	require_once "../../clases/Contactos.php";

	// Obtener el ID del contacto a buscar de la URL
	$ID = $_GET['id'];

	// Verificar si se proporcionó un ID de contacto válido
	if(isset($ID) && !empty($ID)) {
		// Crear una instancia de la clase Contactos
		$contactos = new Contactos();

		// Obtener los datos del contacto
		$contacto = $contactos->obtenerDatosContacto($ID);

		// Devolver los datos del contacto como JSON
		echo json_encode($contacto);
	} else {
		// Devolver un mensaje de error si no se proporcionó un ID válido
		echo json_encode(array('error' => 'No se proporcionó un ID de contacto válido.'));
	}
?>
