<?php

require_once "Conexion.php";

class Proyecto extends Conexion {

	public function mostrarDatos() {
		$sql = "SELECT pro.id_proyecto,
					   pro.nombre,
					   pro.titulo,
					   pro.area_aplicacion
				  FROM t_proyecto as pro";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}
	public function nombreAsesor($id) {
	    $sql = "SELECT 	   usu.nombre
				from       t_asesor as ase
				inner join t_proyecto as pro on ase.id_asesor = pro.id_asesor
				inner join t_usuario as usu on ase.id_usuario = usu.id_usuario
				and  pro.id_proyecto = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $result = $query->fetch()[0];
	    $query->close();
  	}
  	public function nombreEstudiante($id) {
	    $sql = "SELECT 	   usu.nombre
				from       t_estudiante as est
				inner join t_proyecto_estudiante as pro on est.id_estudiante = pro.id_estudiante
				inner join t_usuario as usu on est.id_usuario = usu.id_usuario
				and  pro.id_proyecto = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $result = $query->fetch()[0];
	    $query->close();
  	}
	public function mostrarDatosMaterias() {
		$sql = "SELECT pro.id_materia,
					   pro.nombre,
					   pro.clave
				  FROM t_proyecto_asignatura as pro";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}
	public function insertarDatosProyecto($datos) {
		$sql = "INSERT INTO t_proyecto (nombre,
										titulo,
										area_aplicacion,
										id_asesor)
		  		   VALUES (:nombre,:titulo,:area_aplicacion,:id_asesor)";
		$con = Conexion::conectar();
		$query = $con->prepare($sql);
		$query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
		$query->bindParam(":titulo", $datos['titulo'],PDO::PARAM_STR);
		$query->bindParam(":area_aplicacion", $datos['area_aplicacion'],PDO::PARAM_STR);
		$query->bindParam(":id_asesor", $datos['id_asesor'],PDO::PARAM_INT);
		$result = $query->execute();
		$lastID = $con->lastInsertId();
		return $datos  = array ('execute' => $result, 'lastID' => $lastID); 
		$query->close();
	}
	public function insertarProyectoEstudiante($id_estudiante,$id_proyecto) {
		$sql = "INSERT INTO t_proyecto_estudiante (id_estudiante, id_proyecto)
		  		   VALUES (:id_estudiante,:id_proyecto)";
		$con = Conexion::conectar();
		$query = $con->prepare($sql);
		$query->bindParam(":id_estudiante", $id_estudiante,PDO::PARAM_STR);
		$query->bindParam(":id_proyecto", $id_proyecto,PDO::PARAM_STR);
		return $query->execute();
		$query->close();
	}
	public function buscarAsesorProyecto($id_asesor) {
	    $sql="SELECT * from t_proyecto where id_asesor='$id_asesor'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $result=$query->rowCount();
		    if ($result > 0) {
		      return "existeA";
		    } else {
		      return "noexisteA";
		    }
	    $query->close();
	}
	public function buscarEstudianteProyecto($id_estudiante) {
	    $sql="SELECT * from t_proyecto_estudiante where id_estudiante='$id_estudiante'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $result=$query->rowCount();
		    if ($result > 0) {
		      return "existeE";
		    } else {
		      return "noexisteE";
		    }
	    $query->close();
	}
	public function obtenerDatos($id) {
	    $sql = "SELECT 	pro.nombre,
	   				   	pro.titulo,
       					pro.area_aplicacion,
       					pro.id_proyecto,
       					pro.id_asesor
  				  FROM 	t_proyecto as pro
				 WHERE 	pro.id_proyecto = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    $result = $query->fetch();

		$sql = "SELECT 	est.id_estudiante
  				  FROM 	t_proyecto_estudiante as est
				 WHERE 	est.id_proyecto = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    $idEstudiante = $query->fetch()[0];

	    return $datos  = array('nombre' 		  => $result[0], 
								'titulo' 		  => $result[1],
								'area_aplicacion' => $result[2],
								'id_proyecto'	  => $result[3],
								'id_asesor'  	  => $result[4],
								'id_estudiante'   => $idEstudiante,
							);
	    //
  	}
  	public function actualizarDatos($datos) {
		$sql = "UPDATE t_cat_carrera 
	           SET nombre= :nombre,
                   clave= :clave
             WHERE id_carrera=:id_carrera";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_carrera", $datos['id_carrera'],PDO::PARAM_INT);
		$query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
		$query->bindParam(":clave", $datos['clave'],PDO::PARAM_INT);
		return $query->execute();
		$query->close();
  	}
  	public function buscarAsesor($id_asesor,$id_proyecto) {
	    $sql="SELECT * from t_proyecto where id_asesor='$id_asesor' and id_proyecto='$id_proyecto'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $result=$query->rowCount();
		    if ($result > 0) {
		      return "mismoA";
		    } else {
		      return "diferenteA";
		    }
	    $query->close();
	}
	public function buscarEstudiante($id_estudiante, $id_proyecto) {
	    $sql="SELECT * from t_proyecto_estudiante where id_estudiante='$id_estudiante' and id_proyecto='$id_proyecto'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $result=$query->rowCount();
		    if ($result > 0) {
		      return "mismoE";
		    } else {
		      return "diferenteE";
		    }
	    $query->close();
	}

}// ./ end class

?>