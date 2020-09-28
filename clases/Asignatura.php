<?php

require_once "Conexion.php";

class Asignatura extends Conexion {

	public function mostrarDatos() {
		$sql = "SELECT asignatura.id_asignatura,
					   asignatura.nombre,
					   asignatura.clave,
					   asignatura.creditos
				  FROM t_asignatura as asignatura
				  ";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}
	public function nombreCarrera($id_asignatura) {
		$sql = "SELECT carrera.nombre
				  FROM t_cat_carrera as carrera
			INNER JOIN t_asignatura_carrera as carAsig 
			        on carrera.id_carrera = carAsig.id_carrera
			       and carAsig.id_asignatura = '$id_asignatura'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetch()[0];
		$query->close();
	}
	public function insertarDatos($datos) {
	    if (self::buscarClave($datos['clave'])) {
	      return "existe";
	    }else {
	      $sql = "INSERT INTO t_asignatura (nombre,clave,creditos)
	          		   VALUES (:nombre,:clave,:creditos)";
	      $con = Conexion::conectar();
	      $query = $con->prepare($sql);
	      $query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
	      $query->bindParam(":clave", $datos['clave'],PDO::PARAM_INT);
	      $query->bindParam(":creditos", $datos['creditos'],PDO::PARAM_INT);
	      $query->execute();
	      return $result = $con->lastInsertId();
	      $query->close();
	    }
	}
	public function insertarAreaAplicacion($id_asignatura) {
		$sql = "INSERT INTO t_area_aplicacion (id_asignatura)
		          		   VALUES (:id_asignatura)";
		$con = Conexion::conectar();
		$query = $con->prepare($sql);
		$query->bindParam(":id_asignatura", $id_asignatura,PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
	public function insertarAsignaturaCarrera($datos) {
		$sql = "INSERT INTO t_asignatura_carrera (id_carrera,id_asignatura)
		  		   VALUES (:id_carrera,:id_asignatura)";
		$con = Conexion::conectar();
		$query = $con->prepare($sql);
		$query->bindParam(":id_carrera", $datos['id_carrera'],PDO::PARAM_INT);
		$query->bindParam(":id_asignatura", $datos['id_asignatura'],PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
	public function obtenerDatos($id) {
	    $sql = "SELECT 	asig.nombre,
	   				   	asig.creditos,
       					asig.clave,
       					asig.id_asignatura
  				  FROM 	t_asignatura as asig
				 WHERE 	asig.id_asignatura = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $result = $query->fetch();
	    $query->close();
  	}
	public function obtenerCarrera($id) {
	    $sql = "SELECT id_carrera
				  FROM t_asignatura_carrera
				 WHERE id_asignatura = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $result = $query->fetch()[0];
	    $query->close();
  	}
  	public function actualizarDatosAsignatura($datos) {
  		if ($datos['aux'] != "conClave" ) {
  			$sql = "UPDATE t_asignatura 
	                   SET nombre= :nombre,
                           creditos= :creditos
                     WHERE id_asignatura=:id_asignatura";
			$query = Conexion::conectar()->prepare($sql);
			$query->bindParam(":id_asignatura", $datos['id_asignatura'],PDO::PARAM_INT);
			$query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
			$query->bindParam(":creditos", $datos['creditos'],PDO::PARAM_INT);
			return $query->execute();
  		} else {
  			$sql = "UPDATE t_asignatura 
	               	   SET nombre= :nombre,
                       	   creditos= :creditos,
                       	   clave= :clave
                     WHERE id_asignatura=:id_asignatura";
				$query = Conexion::conectar()->prepare($sql);
				$query->bindParam(":id_asignatura", $datos['id_asignatura'],PDO::PARAM_INT);
				$query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
				$query->bindParam(":creditos", $datos['creditos'],PDO::PARAM_INT);
				$query->bindParam(":clave", $datos['clave'],PDO::PARAM_INT);
				return $query->execute();
  		}
		
		$query->close();
  	}
  	public function actualizarAsignaturaCarrera($datos) {
		$sql = "UPDATE t_asignatura_carrera 
	               SET id_carrera= :id_carrera
                 WHERE id_asignatura=:id_asignatura";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_asignatura", $datos['id_asignatura'],PDO::PARAM_INT);
		$query->bindParam(":id_carrera", $datos['id_carrera'],PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
  	public function insertarDatosAsignaturaCarrera($datos) {
		$sql = "INSERT INTO t_asignatura_carrera (id_carrera,id_asignatura)
		  		   VALUES (:id_carrera,:id_asignatura)";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_carrera", $datos['id_carrera'],PDO::PARAM_INT);
		$query->bindParam(":id_asignatura", $datos['id_asignatura'],PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
	public function buscarCarrera($id_asignatura) {
	    $sql="SELECT * from t_asignatura_carrera where id_asignatura='$id_asignatura'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    return $user=$query->fetch()[1];
	    $query->close();
	}
	public function buscarClaveUpdate($clave,$id_asignatura) {
	    $sql="SELECT * from t_asignatura 
	    	   where clave='$clave' and id_asignatura='$id_asignatura'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $user=$query->fetch();
	    if ($user[0] == $id_asignatura and $user[3] == $clave) {
	      return "igual";
	    } else {
	    	//return "dif clave";
	      	return self::buscarClave($clave);
	    }
	}
	public function buscarClave($clave) {
	    $sql="SELECT * from t_asignatura where clave='$clave'";
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
	public function existeCarrera($id_asignatura) {
	    $sql="SELECT * from t_asignatura_carrera where id_asignatura='$id_asignatura'";
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
	public function eliminarDatos($id_asignatura) {
		$sql = "DELETE FROM t_proyecto_asignatura where id_asignatura=:id_asignatura";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_asignatura", $id_asignatura, PDO::PARAM_INT);
	    if ($query->execute()) {
	    	$sql = "DELETE FROM t_asignatura_competencia where id_asignatura=:id_asignatura";
		    $query = Conexion::conectar()->prepare($sql);
		    $query->bindParam(":id_asignatura", $id_asignatura, PDO::PARAM_INT);
		    if ($query->execute()) {
		    	$sql = "DELETE FROM t_asignatura_estudiante where id_asignatura=:id_asignatura";
			    $query = Conexion::conectar()->prepare($sql);
			    $query->bindParam(":id_asignatura", $id_asignatura, PDO::PARAM_INT);
			    if ($query->execute()) {
			    	$sql = "DELETE FROM t_asignatura_carrera where id_asignatura=:id_asignatura";
				    $query = Conexion::conectar()->prepare($sql);
				    $query->bindParam(":id_asignatura", $id_asignatura, PDO::PARAM_INT);
				    if ($query->execute()) {
				    	$sql = "DELETE FROM t_area_aplicacion where id_asignatura=:id_asignatura";
					    $query = Conexion::conectar()->prepare($sql);
					    $query->bindParam(":id_asignatura", $id_asignatura, PDO::PARAM_INT);
					    if ($query->execute()) {
					    	$sql = "DELETE FROM t_asignatura where id_asignatura=:id_asignatura";
						    $query = Conexion::conectar()->prepare($sql);
						    $query->bindParam(":id_asignatura", $id_asignatura, PDO::PARAM_INT);
						    if ($query->execute()) {
						    	return 1;
						    } else {
						    	return 0;
						    }
					    } else {
					    	return 0;
					    }
				    } else {
				    	return 0;
				    }
			    } else {
			    	return 0;
			    }
		    } else {
		    	return 0;
		    }
	    } else {
	    	return 0;
	    }
	}
	// area_aplicacion
	public function obtenerDatosArea($id) {
	    $sql = "SELECT 	area.nombre,
	   				   	area.aportacion,
       					area.nodo_problema,
       					area.id_asignatura
  				  FROM 	t_area_aplicacion as area
				 WHERE 	area.id_asignatura = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $result = $query->fetch();
	    $query->close();
  	}
  	public function actualizarAreaAplicacion($datos) {
		$sql = "UPDATE t_area_aplicacion
	               SET aportacion= :aportacion,
	                   nombre= :nombre,
	                   nodo_problema= :nodo_problema
                 WHERE id_asignatura=:id_asignatura";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":nodo_problema", $datos['nodo_problema'],PDO::PARAM_INT);
		$query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
		$query->bindParam(":aportacion", $datos['aportacion'],PDO::PARAM_STR);
		$query->bindParam(":id_asignatura", $datos['id_asignatura'],PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}

	//estudiantes
	public function mostrarDatosEstudiante($id_asignatura) {
		$sql = "SELECT est.id_estudiante,
					   usu.nombre,
					   est.no_control,
					   asiEst.calif
				  FROM t_estudiante as est
			INNER JOIN t_usuario as usu on est.id_usuario = usu.id_usuario
			INNER JOIN t_asignatura_estudiante as asiEst 
					ON est.id_estudiante = asiEst.id_estudiante
				   AND asiEst.id_asignatura = '$id_asignatura'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}
	public function obtenerDatosEstudiante($id) {
	    $sql = "SELECT 	asigEst.calif,
	   				   	asigEst.id_estudiante
  				  FROM 	t_asignatura_estudiante as asigEst
				 WHERE 	asigEst.id_estudiante = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $result = $query->fetch();
	    $query->close();
  	}
  	public function actualizarDatosEstudiante($datos) {
		$sql = "UPDATE t_asignatura_estudiante 
	               SET calif= :calif
                 WHERE id_estudiante=:id_estudiante";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_estudiante", $datos['id_estudiante'],PDO::PARAM_INT);
		$query->bindParam(":calif", $datos['calificacion'],PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
	public function insertarEstudiante($datos) {
		$sql = "INSERT INTO t_asignatura_estudiante (id_asignatura,id_estudiante)
		  		   VALUES (:id_asignatura,:id_estudiante)";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_asignatura", $datos['id_asignatura'],PDO::PARAM_INT);
		$query->bindParam(":id_estudiante", $datos['id_estudiante'],PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
	public function existeEstudiante($id_estudiante,$id_asignatura) {
	    $sql="SELECT * from t_asignatura_estudiante 
	    			  where id_estudiante='$id_estudiante' and id_asignatura='$id_asignatura'";
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
	public function eliminarEstudiante($id_estudiante,$id_asignatura) {
	    $sql = "DELETE FROM t_asignatura_estudiante 
	    	          where id_estudiante=:id_estudiante and id_asignatura=:id_asignatura";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_estudiante", $id_estudiante, PDO::PARAM_INT);
	    $query->bindParam(":id_asignatura", $id_asignatura, PDO::PARAM_INT);
	    return $query->execute();
	    $query->close();
	}
}

?>