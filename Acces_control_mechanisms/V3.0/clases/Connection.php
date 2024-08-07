
<?php 
	
	class Connection {
		private $host = "localhost";
		private $usuario = "root";
		private $contrasena = "";
		private $baseDatos = "acces_control_mechanisms_db";
	
		public function connect() {
			$conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->baseDatos);
	
			// Verificar si hubo un error en la conexión
			if ($conexion->connect_error) {
				error_log("Error en la conexión: " . $conexion->connect_error);
				throw new Exception("Error en la conexión: " . $conexion->connect_error);
			}
	
			return $conexion;
		}
	}
	

 ?>