<?php 

	require_once "../../clases/UserTeam.php";

	// Instanciar la clase Contactos
	$userTeamInstance = new UserTeam();
	
	// Obtener todos los usuarios
	$userTeamList = $userTeamInstance->getAllUsersTeams();

	// Devolver los datos en formato JSON
	echo json_encode($userTeamList);

?>
