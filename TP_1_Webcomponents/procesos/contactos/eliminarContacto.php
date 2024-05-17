<?php 
	// Incluir la clase Contactos
	require_once "../../clases/Contactos.php";

	// Obtener el ID del contacto a obtener del POST en formato JSON
	$datos = json_decode(file_get_contents("php://input"), true);

	// Verificar si se recibió un ID válido
	if(isset($datos['ID']) && !empty($datos['ID'])) {
		// Crear una instancia de la clase Contactos
		$contactos = new Contactos();

		// Obtener los datos del contacto
		$contacto = $contactos->eliminarContacto($datos['ID']);

		// Devolver los datos del contacto como JSON
		echo json_encode($contacto);
	} else {
		// Devolver un mensaje de error si no se proporcionó un ID válido
		echo json_encode(array('error' => 'No se proporcionó un ID de contacto válido.'));
	}
?>

