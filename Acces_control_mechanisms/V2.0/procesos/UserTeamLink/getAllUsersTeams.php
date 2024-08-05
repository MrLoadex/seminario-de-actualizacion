<?php 

	require_once "../../clases/UserTeamLink.php";

	// Instanciar la clase Contactos
	$userTeamInstance = new UsersTeamLink();
	
	// Obtener todos los usuarios
	$TeamActionLinkList = $userTeamInstance->getAllUsersTeams();

	// Devolver los datos en formato JSON
	echo json_encode($TeamActionLinkList);

?>
