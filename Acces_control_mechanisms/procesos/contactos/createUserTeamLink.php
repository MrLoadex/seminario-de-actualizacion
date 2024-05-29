<?php 
	// Incluir la clase Users
	require_once "../../clases/Users.php";

	// Obtener los datos del POST en formato JSON y convertirlos a un array asociativo
	$datos = json_decode(file_get_contents("php://input"), true);

	// Verificar si se recibieron los datos esperados (userID y teamID)
	if (isset($datos['userID']) && isset($datos['teamID'])) {
		// Crear una instancia de la clase Users
		$users = new Users();

		// Llamar al método createUserTeamLink() y pasarle los datos
		$resultado = $users->createUserTeamLink($datos['userID'], $datos['teamID']);

		// Devolver el resultado de la vinculación como JSON
		echo json_encode(['success' => $resultado]);
	} else {
		// Devolver un mensaje de error si los datos no están completos
		echo json_encode(['error' => 'Los datos enviados están incompletos']);
	}
	?>
