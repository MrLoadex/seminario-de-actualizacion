<?php 

require_once "../../clases/TeamActionLink.php";

	// Instanciar la clase Contactos
	$userTeamInstance = new TeamActionLink();
	
	// Obtener todos los usuarios
	$TeamActionLinkList = $userTeamInstance->getAllTeamsActions();

	// Devolver los datos en formato JSON
	echo json_encode($TeamActionLinkList);

?>
