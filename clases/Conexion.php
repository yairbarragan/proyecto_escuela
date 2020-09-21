<?php 


class Conexion {
	public static function conectar() {
		/*try {
			$conexion = new PDO("mysql:host=localhost;dbname=escuela;charset=utf8mb4", "root", "");  
       		//echo "Conexión realizada Satisfactoriamente";
			return $conexion;    
		}

		catch(PDOException $e)
		{
        	echo "La conexión ha fallado: " . $e->getMessage();
		}*/
		static $conexion;

    $bd = 'mysql:host=localhost;dbname=escuela;charset=utf8mb4';
    $username = 'root';
    $password = '';

    if (!$conexion) {
       $conexion = new PDO($bd, $username, $password);
    }
    return $conexion;
	}
}


 ?>