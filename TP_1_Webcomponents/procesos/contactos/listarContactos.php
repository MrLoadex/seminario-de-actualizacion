<?php 

	require_once "../../clases/Contactos.php";

	// Instanciar la clase Contactos
	$contactos = new Contactos();

	// Obtener todos los usuarios
	$usuarios = $contactos->obtenerTodosLosContactos();

	// Devolver los datos en formato JSON
	echo json_encode($usuarios);

?>
