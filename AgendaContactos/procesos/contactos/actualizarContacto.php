<?php 

	require_once "../../clases/Contactos.php";
	$Contactos = new Contactos();

	$datos = array(
				"idContacto" => $_POST['idContacto'],
				"nombre" => $_POST['nombre'],
				"paterno" => $_POST['apaterno'],
				"materno" => $_POST['amaterno'],
				"telefono" => $_POST['telefono'],
				"email" => $_POST['email'],
					);

	echo $Contactos->actualizarContacto($datos);
 ?>