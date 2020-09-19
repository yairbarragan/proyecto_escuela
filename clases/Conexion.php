<?php 

/*	class Conectar{
	public function conexion() {
			$servidor = "localhost";
			$usuario = "root";
			$password = "";
			$base = "escuela";

			$conexion = mysqli_connect($servidor, 
										$usuario, 
										$password, 
										$base);

			$conexion->set_charset('utf8mb4');
			return $conexion;
		}
	}

*/

class Conexion {
	public static function conectar() {
		try {
			$conexion = new PDO("mysql:host=localhost;dbname=escuela;charset=utf8mb4", "root", "");  
       		//echo "Conexión realizada Satisfactoriamente";
			return $conexion;    
		}

		catch(PDOException $e)
		{
        	echo "La conexión ha fallado: " . $e->getMessage();
		}
	}
}
 

 ?>