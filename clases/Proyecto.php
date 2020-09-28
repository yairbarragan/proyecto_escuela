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
		$query->bindParam(":id_estudiante", $id_estudiante,PDO::PARAM_INT);
		$query->bindParam(":id_proyecto", $id_proyecto,PDO::PARAM_INT);
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
		$sql = "UPDATE t_proyecto 
	           SET nombre= :nombre,
                   titulo= :titulo,
                   area_aplicacion= :area_aplicacion,
                   id_asesor= :id_asesor
             WHERE id_proyecto=:id_proyecto";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_proyecto", $datos['id_proyecto'],PDO::PARAM_INT);
		$query->bindParam(":id_asesor", $datos['id_asesor'],PDO::PARAM_INT);
		$query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
		$query->bindParam(":titulo", $datos['titulo'],PDO::PARAM_STR);
		$query->bindParam(":area_aplicacion", $datos['area_aplicacion'],PDO::PARAM_STR);
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
	public function existeAsesor($id_asesor) {
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
	public function existeEstudiante($id_estudiante) {
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
	public function eliminarProyectoEstudiante($id_proyecto) {
		$sql = "DELETE FROM t_proyecto_estudiante where id_proyecto=:id_proyecto";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
	    return $query->execute();
	    $query->close();
	}
	public function eliminarDatos($id_proyecto) {
		//borra de t_archivos --> t_proyecto_asignatura --> t_proyecto_estudiante --> t_proyecto
		$sql = "DELETE FROM t_archivos where id_proyecto=:id_proyecto";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
	    if ($query->execute()) {
	    	$sql = "DELETE FROM t_proyecto_asignatura where id_proyecto=:id_proyecto";
		    $query = Conexion::conectar()->prepare($sql);
		    $query->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
		    if ($query->execute()) {
		    	$sql = "DELETE FROM t_proyecto_estudiante where id_proyecto=:id_proyecto";
			    $query = Conexion::conectar()->prepare($sql);
			    $query->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
			    if ($query->execute()) {
			    	$sql = "DELETE FROM t_proyecto where id_proyecto=:id_proyecto";
				    $query = Conexion::conectar()->prepare($sql);
				    $query->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
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
	}
	public function insertarDatosMateria($id_proyecto,$id_asignatura) {
		$sql = "INSERT INTO t_proyecto_asignatura (id_asignatura,
										id_proyecto)
		  		   VALUES (:id_asignatura,:id_proyecto)";
		$con = Conexion::conectar();
		$query = $con->prepare($sql);
		$query->bindParam(":id_asignatura", $id_asignatura,PDO::PARAM_INT);
		$query->bindParam(":id_proyecto", $id_proyecto,PDO::PARAM_INT);
		return $result = $query->execute();
		$query->close();
	}
	public function mostrarDatosMaterias($id_proyecto) {
		$sql = "SELECT pro.id_asignatura,
					   asi.nombre,
					   asi.clave
				  FROM t_proyecto_asignatura as pro
			INNER JOIN t_asignatura as asi on pro.id_asignatura = asi.id_asignatura
				   AND pro.id_proyecto = '$id_proyecto'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}
	public function eliminarProyectoAsignatura($id_asignatura,$id_proyecto) {
		$sql = "DELETE FROM t_proyecto_asignatura 
					  where id_asignatura=:id_asignatura and id_proyecto=:id_proyecto";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_asignatura", $id_asignatura, PDO::PARAM_INT);
	    $query->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
	    return $query->execute();
	    $query->close();
	}
	public function existeMateria($id_asignatura, $id_proyecto) {
	    $sql="SELECT * from t_proyecto_asignatura 
	    			  where id_asignatura='$id_asignatura' and id_proyecto='$id_proyecto'";
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
	public function agregarDatosArchivos($datos) {
	    $sql      = "INSERT INTO   t_archivos (id_proyecto,nombre,ruta,tipo,extension,nombre_original)
	                 VALUES (:id_proyecto, :nombre, :ruta, :tipo, :extension, :original)";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_proyecto", $datos['id_proyecto'],PDO::PARAM_INT);
	    $query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
	    $query->bindParam(":ruta", $datos['ruta'],PDO::PARAM_STR);
	    $query->bindParam(":tipo", $datos['tipo'],PDO::PARAM_STR);
	    $query->bindParam(":extension", $datos['extension'],PDO::PARAM_STR);
	    $query->bindParam(":original", $datos['original'],PDO::PARAM_STR);
	    return $query->execute();
	    $query->close();
  	}
  	public function obtenerArchivo($idProyecto) {
	    $sql      = "SELECT id_archivos,
	                        nombre,
	                        ruta,
	                        tipo,
	                        nombre_original
	                  FROM  t_archivos
	                 WHERE  id_proyecto='$idProyecto'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $datos = $query->fetchAll();
	    $cadena  = "";
	    if ($query->rowCount() == 0) {
	        $cadena = $cadena . '
	          <p class="pt-4"><b style="color:#D73925;">No hay</b> archivos para este asunto <b style="color:#D73925;">!!!</b>';
	      return $cadena;
	    } else {
	        foreach ($datos as $key => $value) {
	          $cadena  = $cadena . '
	            <div class="mr-4 archivo-pdf col-md-2">
	              <a href="' . '../archivos/' . $value['nombre'] . '" target="_blank" download="'. $value['nombre_original'] .'">
	                <i class="fas fa-file-alt archivo-modal"></i>
	              </a>
	              <p>'.$value['nombre_original'].'</p>
	              <i class="fas fa-trash-alt eliminar-archivo" 
	                onclick="eliminarArchivo('.$value['id_archivos'].')">
	              </i>
	            </div>
	            ';
	        }
	      return $cadena;
	    }
  	}
  	public function eliminarArchivo($idArchivo) {
	    $sql      = "SELECT nombre,ruta FROM t_archivos where id_archivos='$idArchivo'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $datos = $query->fetch();
	    if (file_exists("../../archivos/" . $datos['nombre'])) {
	      if (unlink("../../archivos/" . $datos['nombre'])) {
	          return 1;
	      } else {
	          return 0;
	      }
	    } else {
	      return 0;
	    }
  	}
  	public function eliminarArchivosProyecto($idProyecto) {
	    $sql      = "SELECT id_archivos FROM t_archivos where id_proyecto='$idProyecto'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $datos = $query->fetchAll();
	    foreach ($datos as $key => $value) {
	    	self::eliminarArchivo($value['id_archivos']);
        }
        return 1;
  	}
  	public function eliminarDatosArchivo($idArchivo) {
		$sql = "DELETE FROM t_archivos where id_archivos=:idArchivo";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":idArchivo", $idArchivo, PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
}// ./ end class

?>