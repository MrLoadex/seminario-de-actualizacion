
<?php 
	
	class Conexion {
		private $host = "localhost";
		private $usuario = "root";
		private $contrasena = "";
		private $baseDatos = "contactos_saldo";
	
		public function conectar() {
			// Intentar establecer la conexión
			$conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->baseDatos);
	
			// Verificar si hubo un error en la conexión
			if ($conexion->connect_error) {
				// Si hay un error, registrar el mensaje de error
				error_log("Error en la conexión: " . $conexion->connect_error);
				// Lanzar una excepción
				throw new Exception("Error en la conexión: " . $conexion->connect_error);
			}
	
			// Si la conexión fue exitosa, devolver el objeto de conexión
			return $conexion;
		}
	}
	

 ?>