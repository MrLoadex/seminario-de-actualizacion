<?php 
	require_once "../../clases/Contactos.php";

	// Obtener los datos del contacto a actualizar del cuerpo de la solicitud POST en formato JSON
	$datos = json_decode(file_get_contents("php://input"), true);

	// Verificar si se proporcionaron datos válidos para la actualización
	if(isset($datos['ID'], $datos['userName'], $datos['saldo']) && !empty($datos['ID'])) {
		// Crear una instancia de la clase Contactos
		$contactos = new Contactos();

		// Actualizar los datos del contacto
		$resultado = $contactos->actualizarContacto($datos);

		// Verificar si la actualización fue exitosa
		if($resultado) {
			// Devolver un mensaje de éxito
			echo json_encode(array('success' => true));
		} else {
			// Devolver un mensaje de error si la actualización falló
			echo json_encode(array('error' => 'Error al actualizar el contacto.'));
		}
	} else {
		// Devolver un mensaje de error si no se proporcionaron datos válidos para la actualización
		echo json_encode(array('error' => 'Datos incompletos para actualizar el contacto.'));
	}
?>
