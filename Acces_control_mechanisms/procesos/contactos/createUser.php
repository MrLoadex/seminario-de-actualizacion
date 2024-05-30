<?php 
	// Incluir la clase Contactos
	require_once "../../clases/Users.php";

	// Obtener los datos del POST en formato JSON y convertirlos a un array asociativo
	$datos = json_decode(file_get_contents("php://input"), true);

	// Verificar si se recibieron los datos esperados (userName y saldo)
	if(isset($datos['name'])) {
	// Agregar el dato ID = 1 al array de datos

		// Crear una instancia de la clase Contactos
		$users = new Users();

		// Llamar al método addUser() y pasarle los datos
		$resultado = $users->createUser($datos);

		// Devolver el resultado de la inserción como JSON
		echo json_encode(['success' => $resultado]);
	} else {
		// Devolver un mensaje de error si los datos no están completos
		echo json_encode(['error' => 'Los datos enviados están incompletos']);
	}
?>