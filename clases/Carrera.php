<?php

require_once "Conexion.php";

class Carrera extends Conexion {

	public function mostrarDatos() {
		$sql = "SELECT carrera.id_carrera,
					   carrera.nombre,
					   carrera.clave
		from t_cat_carrera as carrera";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}
	public function insertarDatos($datos) {
	    if (self::buscarClave($datos['clave'])) {
	      return "existe";
	    }else {
	      $sql = "INSERT INTO t_cat_carrera (nombre,clave)
	          		   VALUES (:nombre,:clave)";
	      $con = Conexion::conectar();
	      $query = $con->prepare($sql);
	      $query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
	      $query->bindParam(":clave", $datos['clave'],PDO::PARAM_INT);
	      return $query->execute();
	      $query->close();
	    }
	}
	public function obtenerDatos($id) {
	    $sql = "SELECT * FROM t_cat_carrera WHERE id_carrera =:id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $result = $query->fetch();
	    $query->close();
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
  	public function actualizarDatosNombre($datos) {
		$sql = "UPDATE t_cat_carrera 
	           SET nombre= :nombre
             WHERE id_carrera=:id_carrera";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_carrera", $datos['id_carrera'],PDO::PARAM_INT);
		$query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
		return $query->execute();
		$query->close();
  	}
  	public function buscarClaveUpdate($clave,$id_carrera) {
	    $sql="SELECT * from t_cat_carrera 
	    	   where clave='$clave' and id_carrera='$id_carrera'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $user=$query->fetch();
	    if ($user[0] == $id_carrera and $user[1] == $clave) {
	      return "igual";
	    } else {
	    	//return "dif clave";
	      	return self::buscarClave($clave);
	    }
	}
	public function buscarClave($clave) {
	    $sql="SELECT * from t_cat_carrera where clave='$clave'";
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
	public function eliminarCarreraAsesor($id_carrera) {
		$id_null = null;
		$sql = "UPDATE t_asesor 
	           	   SET id_carrera=:id_car
                 WHERE id_carrera=:id_carrera";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_carrera", $id_carrera, PDO::PARAM_INT);
	    $query->bindParam(":id_car", $id_null, PDO::PARAM_INT);
	    return $query->execute();
	    $query->close();
	}
	public function eliminarCarreraEspecialidad($id_carrera) {
		$sql = "DELETE FROM t_carrera_especialidad where id_carrera=:id_carrera";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_carrera", $id_carrera, PDO::PARAM_INT);
	    return $query->execute();
	    $query->close();
	}
	public function eliminarAsignaturaCarrera($id_carrera) {
		$sql = "DELETE FROM t_asignatura_carrera where id_carrera=:id_carrera";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_carrera", $id_carrera, PDO::PARAM_INT);
	    return $query->execute();
	    $query->close();
	}
	public function eliminarDatos($id_carrera) {
		$sql = "DELETE FROM t_cat_carrera where id_carrera=:id_carrera";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_carrera", $id_carrera, PDO::PARAM_INT);
	    return $query->execute();
	    $query->close();
	}
}

?>