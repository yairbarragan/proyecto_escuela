<?php

require_once "Conexion.php";

class Especialidad extends Conexion {

	public function mostrarDatos() {
		$sql = "SELECT especialidad.nombre,
					   especialidad.id_especialidad,
					   especialidad.periodo_vigencia
				  FROM t_cat_especialidad as especialidad";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}
	public function nombreCarrera($id_especialidad) {
		$sql = "SELECT carrera.nombre
				  FROM t_cat_carrera as carrera
			INNER JOIN t_carrera_especialidad as carEsp 
			        on carrera.id_carrera = carEsp.id_carrera
			       and carEsp.id_especialidad = '$id_especialidad'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetch()[0];
		$query->close();
	}
	public function insertarDatos($datos) {
		$sql = "INSERT INTO t_cat_especialidad (nombre,periodo_vigencia)
		  		   VALUES (:nombre,:periodo_vigencia)";
		$con = Conexion::conectar();
		$query = $con->prepare($sql);
		$query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
		$query->bindParam(":periodo_vigencia", $datos['periodo_vigencia'],PDO::PARAM_STR);
		$query->execute();
		return $con->lastInsertId();
		$query->close();
	}
	public function insertarDatosCarreraEspecialidad($datos) {
		$sql = "INSERT INTO t_carrera_especialidad (id_carrera,id_especialidad)
		  		   VALUES (:id_carrera,:id_especialidad)";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_carrera", $datos['id_carrera'],PDO::PARAM_INT);
		$query->bindParam(":id_especialidad", $datos['id_especialidad'],PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
	public function obtenerDatos($id) {
	    $sql = "SELECT 	esp.nombre,
	   				   	esp.periodo_vigencia,
       					esp.id_especialidad
  				  FROM 	t_cat_especialidad as esp
				 WHERE 	esp.id_especialidad = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $result = $query->fetch();
	    $query->close();
  	}
  	public function obtenerCarrera($id) {
	    $sql = "SELECT id_carrera
				  FROM t_carrera_especialidad
				 WHERE id_especialidad = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $result = $query->fetch()[0];
	    $query->close();
  	}
  	public function actualizarDatosEspecialidad($datos) {
		$sql = "UPDATE t_cat_especialidad 
	               SET nombre= :nombre,
                       periodo_vigencia= :periodo_vigencia
                 WHERE id_especialidad=:id_especialidad";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_especialidad", $datos['id_especialidad'],PDO::PARAM_INT);
		$query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
		$query->bindParam(":periodo_vigencia", $datos['periodo_vigencia'],PDO::PARAM_STR);
		return $query->execute();
		$query->close();
  	}
  	public function actualizarDatosCarrera($datos) {
		$sql = "UPDATE t_carrera_especialidad 
	               SET id_carrera= :id_carrera
                 WHERE id_especialidad=:id_especialidad";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_especialidad", $datos['id_especialidad'],PDO::PARAM_INT);
		$query->bindParam(":id_carrera", $datos['id_carrera'],PDO::PARAM_INT);
		return $query->execute();
		$query->close();
  	}
  	//elimina datos de tabla t_carrera_especialidad
  	public function eliminarDatos($id_especialidad) {
	    $sql = "DELETE FROM t_carrera_especialidad where id_especialidad=:id_especialidad";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_especialidad", $id_especialidad, PDO::PARAM_INT);
	    $result = $query->execute();
	    if ($result > 0) {
	    	$sql = "DELETE FROM t_cat_especialidad where id_especialidad=:id_especialidad";
		    $query = Conexion::conectar()->prepare($sql);
		    $query->bindParam(":id_especialidad", $id_especialidad, PDO::PARAM_INT);
		    $result = $query->execute();
		    if ($result > 0) {
		    	return 1;
		    } else {
		    	return 0;
		    }
	    }else {
	    	return 0;
	    }


	    $query->close();
	}
	public function buscarCarrera($id_especialidad) {
	    $sql="SELECT * from t_carrera_especialidad where id_especialidad='$id_especialidad'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $cuenta=$query->rowCount();
	    if ($cuenta > 0) {
	      return 1;
	    } else {
	      return 0;
	    }
	    $query->close();
	}



}// ./end class 

?>