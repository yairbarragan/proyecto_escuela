<?php

require_once "Conexion.php";

class Usuario extends Conexion {

	public function login($usuario, $password) {
		$sql = "SELECT count(*)
				FROM t_usuario 
				WHERE usuario = '$usuario' 
					AND password = '$password'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		$respuesta = $query->fetch()[0];
		if ( $respuesta > 0) {
			$sql = "SELECT usuario.id_usuario as idUsuario,
					       rol.id_rol_usuario as idRolUsuario,
					       rol.nombre as nombreRol
					  FROM t_usuario AS usuario
				INNER JOIN t_rol_usuario AS rol ON usuario.id_rol_usuario = rol.id_rol_usuario
					   AND usuario.usuario = '$usuario'
					   AND usuario.password = '$password'";

				$query = Conexion::conectar()->prepare($sql);
				$query->execute();
				$datosUsuario = $query->fetch();
				$_SESSION['datosUsuario']['id']      = $datosUsuario['idUsuario'];
				$_SESSION['datosUsuario']['idRol']   = $datosUsuario['idRolUsuario'];
				$_SESSION['datosUsuario']['rol']     = $datosUsuario['nombreRol'];
				$_SESSION['datosUsuario']['usuario'] = $usuario;

			return 1;
		} else {
			return 0;
		}
	}
	public function mostrarDatos() {
		$sql = "SELECT usuario.id_usuario,
					   usuario.nombre,
					   usuario.email,
					   usuario.usuario,
                       rol.id_rol_usuario,
                       rol.nombre as tipo
				  FROM t_usuario AS usuario
		    INNER JOIN t_rol_usuario AS rol ON usuario.id_rol_usuario = rol.id_rol_usuario
				   AND rol.id_rol_usuario != 1";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}
	public function insertarDatosUsuario($datos) {
	    if (self::buscarUsuario($datos['usuario'])) {
	      return "existe";
	    }else {
	      $sql = "INSERT INTO t_usuario (nombre,
	                              usuario,
	                              email,
	                              password,
	                              id_rol_usuario)
	          		   VALUES (:nombre,:usuario,:email,:password,:id_rol_usuario)";
	      $con = Conexion::conectar();
	      $query = $con->prepare($sql);
	      $query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
	      $query->bindParam(":usuario", $datos['usuario'],PDO::PARAM_STR);
	      $query->bindParam(":email", $datos['email'],PDO::PARAM_STR);
	      $query->bindParam(":password", $datos['password'],PDO::PARAM_STR);
	      $query->bindParam(":id_rol_usuario", $datos['id_rol_usuario'],PDO::PARAM_INT);
	      $query->execute();
		  return $con->lastInsertId();
	      $query->close();
	    }
	}
  	public function insertarDatosAsesor($datos) {
      $sql = "INSERT INTO t_asesor (id_usuario,
                              id_carrera,
                              no_empleado,
                              grado_estudios)
          		   VALUES (:id_usuario,:id_carrera,:no_empleado,:grado_estudios)";
      $con = Conexion::conectar();
      $query = $con->prepare($sql);
      $query->bindParam(":id_usuario", $datos['id_usuario'],PDO::PARAM_INT);
      $query->bindParam(":id_carrera", $datos['id_carrera'],PDO::PARAM_INT);
      $query->bindParam(":no_empleado", $datos['no_empleado'],PDO::PARAM_INT);
      $query->bindParam(":grado_estudios", $datos['grado_estudios'],PDO::PARAM_STR);
      return $query->execute();
      $query->close();
    }
    public function insertarDatosEstudiante($datos) {
      $sql = "INSERT INTO t_estudiante (id_usuario,
                              no_control,
                              genero,
                              periodo_ingreso,
                              periodo_ingreso_dos)
          		   VALUES (:id_usuario,:no_control,:genero,:periodo_ingreso,:periodo_ingreso_dos)";
      $con = Conexion::conectar();
      $query = $con->prepare($sql);
      $query->bindParam(":id_usuario", $datos['id_usuario'],PDO::PARAM_INT);
      $query->bindParam(":no_control", $datos['no_control'],PDO::PARAM_INT);
      $query->bindParam(":genero", $datos['genero'],PDO::PARAM_STR);
      $query->bindParam(":periodo_ingreso", $datos['periodo_ingreso'],PDO::PARAM_STR);
      $query->bindParam(":periodo_ingreso_dos", $datos['periodo_ingreso_dos'],PDO::PARAM_STR);
      return $query->execute();
      $query->close();
    }
	public function obtenerDatos($id) {
	    $sql = "SELECT id_rol_usuario FROM t_usuario WHERE id_usuario =:id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    $result = $query->fetch();
	    if ($result[0] == 2) {
	    	$sql = "SELECT usuario.id_usuario,
	    			   usuario.nombre, 
	    			   usuario.email, 
	    			   usuario.usuario,
	    			   usuario.password,
	    			   rol.id_rol_usuario,
	    			   asesor.no_empleado,
	    			   asesor.grado_estudios,
	    			   asesor.id_carrera
	              FROM t_usuario as usuario
	        INNER JOIN t_rol_usuario as rol on usuario.id_rol_usuario = rol.id_rol_usuario
	        INNER JOIN t_asesor as asesor on asesor.id_usuario = usuario.id_usuario
	             WHERE usuario.id_usuario=:id";
		    $query = Conexion::conectar()->prepare($sql);
		    $query->bindParam(":id", $id,PDO::PARAM_INT);
		    $query->execute();
		    return $result = $query->fetch();
		    $query->close();
	    } else {
	    	$sql = "SELECT usuario.id_usuario,
	    			   usuario.nombre, 
	    			   usuario.email, 
	    			   usuario.usuario,
	    			   usuario.password,
	    			   rol.id_rol_usuario,
	    			   estudiante.no_control,
	    			   estudiante.genero,
	    			   estudiante.periodo_ingreso,
	    			   estudiante.periodo_ingreso_dos
	              FROM t_usuario as usuario
	        INNER JOIN t_rol_usuario as rol on usuario.id_rol_usuario = rol.id_rol_usuario
	        INNER JOIN t_estudiante as estudiante on estudiante.id_usuario = usuario.id_usuario
	             WHERE usuario.id_usuario=:id";
		    $query = Conexion::conectar()->prepare($sql);
		    $query->bindParam(":id", $id,PDO::PARAM_INT);
		    $query->execute();
		    return $result = $query->fetch();
		    $query->close();
	    }
  	}
  	public function actualizarDatosUsuario($datos) {
  		$existe = self::buscarUsuarioUpdate($datos['usuario'],$datos['id_usuario']);
  		$usuario = $datos['usuario'];
  		if ($existe == 1) {
  			$sql = "UPDATE t_usuario SET nombre= :nombre,
		                            	 usuario= :usuario,
		                            	 email= :email,
		                            	 id_rol_usuario= :id_rol_usuario
		           WHERE id_usuario=:id_usuario";

			$query = Conexion::conectar()->prepare($sql);
			$query->bindParam(":id_usuario", $datos['id_usuario'],PDO::PARAM_INT);
			$query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
			$query->bindParam(":usuario", $datos['usuario'],PDO::PARAM_STR);
			$query->bindParam(":email", $datos['email'],PDO::PARAM_STR);
			$query->bindParam(":id_rol_usuario", $datos['id_rol_usuario'],PDO::PARAM_INT);
			return $query->execute();
			$query->close();
  		}else {
  			if (self::buscarUsuario($datos['usuario'])) {
  				return "existe";
  			}else {
  				$sql = "UPDATE t_usuario SET nombre= :nombre,
		                            	 usuario= :usuario,
		                            	 email= :email,
		                            	 id_rol_usuario= :id_rol_usuario
		           WHERE id_usuario=:id_usuario";

				$query = Conexion::conectar()->prepare($sql);
				$query->bindParam(":id_usuario", $datos['id_usuario'],PDO::PARAM_INT);
				$query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
				$query->bindParam(":usuario", $datos['usuario'],PDO::PARAM_STR);
				$query->bindParam(":email", $datos['email'],PDO::PARAM_STR);
				$query->bindParam(":id_rol_usuario", $datos['id_rol_usuario'],PDO::PARAM_INT);
				return $query->execute();
				$query->close();
  			}
  		}
  	}
  	public function actualizarDatosAsesor($datos) {
		$sql = "UPDATE t_asesor SET id_carrera= :id_carrera,
	                            	 no_empleado= :no_empleado,
	                            	 grado_estudios= :grado_estudios
	           WHERE id_usuario=:id_usuario";

		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_usuario", $datos['id_usuario'],PDO::PARAM_INT);
		$query->bindParam(":id_carrera", $datos['id_carrera'],PDO::PARAM_INT);
		$query->bindParam(":no_empleado", $datos['no_empleado'],PDO::PARAM_INT);
		$query->bindParam(":grado_estudios", $datos['grado_estudios'],PDO::PARAM_STR);
		return $query->execute();
		$query->close();
  	}
  	public function actualizarDatosEstudiante($datos) {
		$sql = "UPDATE t_estudiante SET no_control= :no_control,
	                            	 	genero= :genero,
	                            	 	periodo_ingreso= :periodo_ingreso,
	                            	 	periodo_ingreso_dos= :periodo_ingreso_dos
	           					  WHERE id_usuario=:id_usuario";

		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_usuario", $datos['id_usuario'],PDO::PARAM_INT);
		$query->bindParam(":no_control", $datos['no_control'],PDO::PARAM_INT);
		$query->bindParam(":genero", $datos['genero'],PDO::PARAM_STR);
		$query->bindParam(":periodo_ingreso", $datos['periodo_ingreso'],PDO::PARAM_STR);
		$query->bindParam(":periodo_ingreso_dos", $datos['periodo_ingreso_dos'],PDO::PARAM_STR);
		return $query->execute();
		$query->close();
  	}
  	public function eliminarDatosAsesor($id_usuario) {
	    $sql = "DELETE FROM t_asesor where id_usuario=:id_usuario";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
	    return $query->execute();
	    $query->close();
	}
  	public function eliminarDatosEstudiante($id_usuario) {
	    $sql = "DELETE FROM t_estudiante where id_usuario=:id_usuario";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
	    return $query->execute();
	    $query->close();
	}
	//cuando cambio asesor a alumno elimina 
	public function eliminarProyectoAsig($id_proyecto) {
	    $sql = "DELETE FROM t_proyecto_asignatura where id_proyecto=:id_proyecto";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
	    return $query->execute();
	    //return $cuenta=$query->rowCount();
	    $query->close();
	}
	public function eliminarProyectoEstudiante($id_proyecto) {
	    $sql = "DELETE FROM t_proyecto_estudiante where id_proyecto=:id_proyecto";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
	    return $query->execute();
	    //return $query->rowCount();
	    $query->close();
	}
	public function eliminarEstudianteProyecto($id_estudiante) {
	    $sql = "DELETE FROM t_proyecto_estudiante where id_estudiante=:id_estudiante";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_estudiante", $id_estudiante, PDO::PARAM_INT);
	    return $query->execute();
	    //return $query->rowCount();
	    $query->close();
	}
	public function eliminarAsignaturaEstudiante($id_estudiante) {
	    $sql = "DELETE FROM t_asignatura_estudiante where id_estudiante=:id_estudiante";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_estudiante", $id_estudiante, PDO::PARAM_INT);
	    return $query->execute();
	    //return $query->rowCount();
	    $query->close();
	}
	public function eliminarProyectoArchivo($id_proyecto) {
	    $sql = "DELETE FROM t_archivos where id_proyecto=:id_proyecto";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
	    return $query->execute();
	    //return $query->rowCount();
	    $query->close();
	}
	public function eliminarProyecto($id_proyecto) {
	    $sql = "DELETE FROM t_proyecto where id_proyecto=:id_proyecto";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
	    return $query->execute();
	    //return $query->rowCount();
	    $query->close();
	}
	public function eliminarAsesorCarrera($id_asesor) {
	    $sql = "DELETE FROM t_carrera_asesor where id_asesor=:id_asesor";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_asesor", $id_asesor, PDO::PARAM_INT);
	    return $query->execute();
	    //return $query->rowCount();
	    $query->close();
	}
	// end eliminar datos cascada asesor

	public function eliminarDatos($id_usuario) {
		if (self::existeUsuarioAsesor($id_usuario)) {
			self::eliminarDatosAsesor($id_usuario);
			$sql = "DELETE FROM t_usuario where id_usuario=:id_usuario";
		    $query = Conexion::conectar()->prepare($sql);
		    $query->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
		    return $query->execute();
		    $query->close();
		} else {
			self::eliminarDatosEstudiante($id_usuario);
			$sql = "DELETE FROM t_usuario where id_usuario=:id_usuario";
		    $query = Conexion::conectar()->prepare($sql);
		    $query->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
		    return $query->execute();
		    $query->close();
		}
	}
	public function buscarUsuarioUpdate($usuario,$id_usuario) {
	    $sql="SELECT * from t_usuario where usuario='$usuario' and id_usuario='$id_usuario'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $user=$query->fetch();
	    if ($user[0] == $id_usuario and $user[4] == $usuario) {
	      return 1;
	    } else {
	      return 2;
	    }
	    $query->close();
	}
  	public function buscarUsuario($usuario) {
	    $sql="SELECT * from t_usuario where usuario='$usuario'";
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
	public function buscarIdRol($id_usuario) {
	    $sql="SELECT id_rol_usuario from t_usuario where id_usuario='$id_usuario'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $user=$query->fetch();
	    return $user[0];
	    $query->close();
	}
	public function buscarIDAsesor($id_usuario) {
	    $sql="SELECT id_asesor 
	            from t_asesor 
	           where id_usuario='$id_usuario'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $user=$query->fetch();
	    return $user[0];
	    $query->close();
	}
	public function buscarIDProyecto($id_asesor) {
	    $sql="SELECT id_proyecto 
	            from t_proyecto 
	           where id_asesor='$id_asesor'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $user=$query->fetch();
	    return $user[0];
	    $query->close();
	}
	public function buscarIDEstudiante($id_usuario) {
	    $sql="SELECT id_estudiante 
	            from t_estudiante
	           where id_usuario='$id_usuario'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $user=$query->fetch();
	    return $user[0];
	    $query->close();
	}
	public function existeUsuarioAsesor($id_usuario) {
	    $sql="SELECT * from t_asesor where id_usuario='$id_usuario'";
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
} 
?>