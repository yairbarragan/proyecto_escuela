<?php

require_once "Conexion.php";

class Competencia extends Conexion {

	public function mostrarDatos() {
		$sql = "SELECT comp.id_competencia,
					   comp.nombre,
					   comp.campo_desar_asig,
					   comp.campo_desar_proyint
		from t_competencia as comp";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}
	public function nombreCarrera($id_competencia) {
		$sql = "SELECT asig.nombre
				  FROM t_asignatura as asig
			INNER JOIN t_asignatura_competencia as asigC 
			        on asig.id_asignatura = asigC.id_asignatura
			       and asigC.id_competencia = '$id_competencia'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetch()[0];
		$query->close();
	}
	public function mostrarDatosEntregable($id_competencia) {
		$sql = "SELECT ent.id_entregable,
					   ent.entregable,
					   ent.descripcion,
					   ent.id_competencia
				  from t_entregable as ent
				 where ent.id_competencia = '$id_competencia'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}
	public function nombreCompetencia($id_competencia) {
		$sql = "SELECT comp.nombre
				  FROM t_competencia as comp
			INNER JOIN t_entregable as ent 
			        on comp.id_competencia = ent.id_competencia
			       and ent.id_competencia = '$id_competencia'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetch()[0];
		$query->close();
	}
	public function insertarDatos($datos) {
		$sql = "INSERT INTO t_competencia (nombre,campo_desar_asig,campo_desar_proyint)
		  		   VALUES (:nombre,:campo_desar_asig,:campo_desar_proyint)";
		$con   = Conexion::conectar();
		$query = $con->prepare($sql);
		$query->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
		$query->bindParam(":campo_desar_asig", $datos['campo_desar_asig'], PDO::PARAM_STR);
		$query->bindParam(":campo_desar_proyint", $datos['campo_desar_proyint'], PDO::PARAM_STR);
		$query->execute();
		return $con->lastInsertId();
		$query->close();
	}
	public function insertarIdAsignatura($id_competencia,$id_asignatura) {
		$sql = "INSERT INTO t_asignatura_competencia (id_competencia,id_asignatura)
		  		   VALUES (:id_competencia,:id_asignatura)";
		$con   = Conexion::conectar();
		$query = $con->prepare($sql);
		$query->bindParam(":id_competencia", $id_competencia, PDO::PARAM_INT);
		$query->bindParam(":id_asignatura", $id_asignatura, PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
	public function existeAsignatura($id_asignatura) {
	    $sql="SELECT * from t_asignatura_competencia where id_asignatura='$id_asignatura'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $cuenta=$query->rowCount();
	    if ($cuenta > 0) {
	      return "existeA";
	    } else {
	      return "noexisteA";
	    }
	    $query->close();
	}
	public function insertarIdEntregable($id_competencia) {
		$sql = "INSERT INTO t_entregable (id_competencia)
		  		   VALUES (:id_competencia)";
		$con   = Conexion::conectar();
		$query = $con->prepare($sql);
		$query->bindParam(":id_competencia", $id_competencia, PDO::PARAM_INT);
		$query->execute();
		return $con->lastInsertId();
		$query->close();
	}
	public function obtenerDatos($id) {
	    $sql = "SELECT 	comp.nombre,
	   				   	comp.campo_desar_asig,
       					comp.campo_desar_proyint,
       					comp.id_competencia
  				  FROM 	t_competencia as comp
				 WHERE 	comp.id_competencia = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $result = $query->fetch();
	    $query->close();
  	}
  	public function obtenerAsignatura($id) {
	    $sql = "SELECT id_asignatura
				  FROM t_asignatura_competencia
				 WHERE id_competencia = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $result = $query->fetch()[0];
	    $query->close();
  	}
  	public function buscarAsignaturaCompetencia($id_competencia,$id_asignatura) {
	    $sql="SELECT * from t_asignatura_competencia 
	    			  where id_competencia='$id_competencia' and id_asignatura='$id_asignatura'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $result=$query->rowCount();
		    if ($result > 0) {
		      return "iguales";
		    } else {
		      return "noiguales";
		    }
	    $query->close();
	}
	public function actualizarDatos($datos) {
		$sql = "UPDATE t_competencia 
	           SET nombre= :nombre,
                   campo_desar_asig= :campo_desar_asig,
                   campo_desar_proyint= :campo_desar_proyint
             WHERE id_competencia=:id_competencia";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_competencia", $datos['id_competencia'],PDO::PARAM_INT);
		$query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
		$query->bindParam(":campo_desar_asig", $datos['campo_desar_asig'],PDO::PARAM_STR);
		$query->bindParam(":campo_desar_proyint", $datos['campo_desar_proyint'],PDO::PARAM_STR);
		return $query->execute();
		$query->close();
  	}
  	public function actualizarAsignatura($datos) {
		$sql = "DELETE FROM t_asignatura_competencia where id_competencia=:id_competencia";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_competencia", $datos['id_competencia'], PDO::PARAM_INT);
	    $result = $query->execute(); 
	    if ($result) {
	    	return self::insertarIdAsignatura($datos['id_competencia'],$datos['id_asignatura'],);
	    } else {
	    	return 0;
	    }
  	}

  	//entregable
  	public function obtenerDatosEntregable($id) {
	    $sql = "SELECT 	ent.entregable, ent.descripcion, ent.id_entregable
  				  FROM 	t_entregable as ent
				 WHERE 	ent.id_entregable = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $query->fetch();
	    $query->close();
  	}
  	public function actualizarDatosEntregable($datos) {
		$sql = "UPDATE t_entregable 
	           SET entregable= :entregable,
                   descripcion= :descripcion
             WHERE id_entregable=:id_entregable";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_entregable", $datos['id_entregable'],PDO::PARAM_INT);
		$query->bindParam(":entregable", $datos['entregable'],PDO::PARAM_STR);
		$query->bindParam(":descripcion", $datos['descripcion'],PDO::PARAM_STR);
		return $query->execute();
		$query->close();
  	}
  	public function insertarEvidencia($id_entregable) {
		$sql = "INSERT INTO t_evidencia (id_entregable)
		  		   VALUES (:id_entregable)";
		$con   = Conexion::conectar();
		$query = $con->prepare($sql);
		$query->bindParam(":id_entregable", $id_entregable, PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
	public function insertarDesempeno($id_entregable) {
		$sql = "INSERT INTO t_desempeno (id_entregable)
		  		   VALUES (:id_entregable)";
		$con   = Conexion::conectar();
		$query = $con->prepare($sql);
		$query->bindParam(":id_entregable", $id_entregable, PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
	public function obtenerDatosEvidencia($id) {
	    $sql = "SELECT 	id_entregable,url,descripcion
  				  FROM 	t_evidencia
				 WHERE 	id_entregable = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $query->fetch();
	    $query->close();
  	}
  	public function obtenerDatosDesempeno($id) {
	    $sql = "SELECT 	puntos,descripcion
  				  FROM 	t_desempeno
				 WHERE 	id_entregable = :id";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id", $id,PDO::PARAM_INT);
	    $query->execute();
	    return $query->fetch();
	    $query->close();
  	}
  	public function actualizarEvidencia($datos) {
		$sql = "UPDATE t_evidencia 
	           	   SET url= :url,
                   	   descripcion= :descripcion
             	 WHERE id_entregable=:id_entregable";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_entregable", $datos['id_entregable'],PDO::PARAM_INT);
		$query->bindParam(":url", $datos['url'],PDO::PARAM_STR);
		$query->bindParam(":descripcion", $datos['descripcionE'],PDO::PARAM_STR);
		return $query->execute();
		$query->close();
  	}
  	public function actualizarDesempeno($datos) {
		$sql = "UPDATE t_desempeno 
	           	   SET puntos= :puntos,
                   	   descripcion= :descripcion
             	 WHERE id_entregable=:id_entregable";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":id_entregable", $datos['id_entregable'],PDO::PARAM_INT);
		$query->bindParam(":puntos", $datos['puntos'],PDO::PARAM_INT);
		$query->bindParam(":descripcion", $datos['descripcionD'],PDO::PARAM_STR);
		return $query->execute();
		$query->close();
  	}

  	//archivos
  		// MA
  	public function agregarDatosArchivosMA($datos) {
	    $sql      = "INSERT INTO   t_archivos_actividadea (id_entregable,
	    													nombre,
	    													ruta,
	    													tipo,
	    													ext,
	    													nombre_original,
	    													id_act_mat_apoyo,
	    													id_act_fue_inf,
	    													id_act_ent,
	    													id_act_ap)
		                 VALUES (:id_entregable,
		                 		 :nombre,
		                 		 :ruta,
		                 		 :tipo,
		                 		 :ext,
		                 		 :original,
		                 		 :id_act_mat_apoyo,
		                 		 :id_act_fue_inf,
		                 		 :id_act_ent,
		                 		 :id_act_ap)";
	    $con   = Conexion::conectar();
		$query = $con->prepare($sql);
	    $query->bindParam(":id_entregable", $datos['id_entregable'],PDO::PARAM_INT);
	    $query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
	    $query->bindParam(":ruta", $datos['ruta'],PDO::PARAM_STR);
	    $query->bindParam(":tipo", $datos['tipo'],PDO::PARAM_STR);
	    $query->bindParam(":ext", $datos['ext'],PDO::PARAM_STR);
	    $query->bindParam(":original", $datos['original'],PDO::PARAM_STR);
	    $query->bindParam(":id_act_mat_apoyo", $datos['id_act_mat_apoyo'],PDO::PARAM_INT);
	    $query->bindParam(":id_act_fue_inf", $datos['id_act_fue_inf'],PDO::PARAM_INT);
	    $query->bindParam(":id_act_ent", $datos['id_act_ent'],PDO::PARAM_INT);
	    $query->bindParam(":id_act_ap", $datos['id_act_ap'],PDO::PARAM_INT);
	    $result = $query->execute();
	    if ($result) {
	    	return $datos['id_entregable'];
	    } else {
	    	return 0;
	    }
	    $query->close();
  	}
  	public function obtenerArchivoMA($idEntregable,$MA) {
	    $sql      = "SELECT id_archivos_actividadEA,
	                        nombre,
	                        ruta,
	                        tipo,
	                        nombre_original
	                  FROM  t_archivos_actividadea
	                 WHERE  id_entregable='$idEntregable' and id_act_mat_apoyo ='$MA'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $datos = $query->fetchAll();
	    $cadena  = "";
	    if ($query->rowCount() == 0) {
	        $cadena = $cadena . '
	          <i class="fas fa-exclamation-circle" style="color:#D73925;position: absolute;
	          margin: 5px 0 0 -16px; font-size: 30px;"></i>';
	      return $cadena;
	    } else {
	        foreach ($datos as $key => $value) {
	          $cadena  = $cadena . '
	            
	              <a href="' . '../archivos/actividad/' . $value['nombre'] . '" target="_blank" download="'. $value['nombre_original'] .'">
	                <i class="fas fa-file-alt" style="font-size:40px;color:#138496;"></i>
	              </a>
	              <i class="fas fa-trash-alt" style="position: absolute;margin: -10px 0 0 0px; color:#C82333;cursor:pointer;" 
	                onclick="eliminarArchivoMA('.$value['id_archivos_actividadEA'].')">
	              </i>
	          
	            ';
	        }
	      return $cadena;
	    }
  	}
  	public function existeArchivoMA($idEntregable,$MA) {
	    $sql="SELECT * from t_archivos_actividadea where id_entregable='$idEntregable' and id_act_mat_apoyo=1";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $cuenta=$query->rowCount();
	    if ($cuenta > 0) {
	      return "existeA";
	    } else {
	      return "noexisteA";
	    }
	    $query->close();
	}
		// FI
	public function agregarDatosArchivosFI($datos) {
	    $sql      = "INSERT INTO   t_archivos_actividadea (id_entregable,
	    													nombre,
	    													ruta,
	    													tipo,
	    													ext,
	    													nombre_original,
	    													id_act_mat_apoyo,
	    													id_act_fue_inf,
	    													id_act_ent,
	    													id_act_ap)
		                 VALUES (:id_entregable,
		                 		 :nombre,
		                 		 :ruta,
		                 		 :tipo,
		                 		 :ext,
		                 		 :original,
		                 		 :id_act_mat_apoyo,
		                 		 :id_act_fue_inf,
		                 		 :id_act_ent,
		                 		 :id_act_ap)";
	    $con   = Conexion::conectar();
		$query = $con->prepare($sql);
	    $query->bindParam(":id_entregable", $datos['id_entregable'],PDO::PARAM_INT);
	    $query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
	    $query->bindParam(":ruta", $datos['ruta'],PDO::PARAM_STR);
	    $query->bindParam(":tipo", $datos['tipo'],PDO::PARAM_STR);
	    $query->bindParam(":ext", $datos['ext'],PDO::PARAM_STR);
	    $query->bindParam(":original", $datos['original'],PDO::PARAM_STR);
	    $query->bindParam(":id_act_mat_apoyo", $datos['id_act_mat_apoyo'],PDO::PARAM_INT);
	    $query->bindParam(":id_act_fue_inf", $datos['id_act_fue_inf'],PDO::PARAM_INT);
	    $query->bindParam(":id_act_ent", $datos['id_act_ent'],PDO::PARAM_INT);
	    $query->bindParam(":id_act_ap", $datos['id_act_ap'],PDO::PARAM_INT);
	    $result = $query->execute();
	    if ($result) {
	    	return $datos['id_entregable'];
	    } else {
	    	return 0;
	    }
	    $query->close();
  	}
  	public function obtenerArchivoFI($idEntregable,$FI) {
	    $sql      = "SELECT id_archivos_actividadEA,
	                        nombre,
	                        ruta,
	                        tipo,
	                        nombre_original
	                  FROM  t_archivos_actividadea
	                 WHERE  id_entregable='$idEntregable' and id_act_fue_inf ='$FI'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $datos = $query->fetchAll();
	    $cadena  = "";
	    if ($query->rowCount() == 0) {
	        $cadena = $cadena . '
	          <i class="fas fa-exclamation-circle" style="color:#D73925;position: absolute;
	          margin: 5px 0 0 -16px; font-size: 30px;"></i>';
	      return $cadena;
	    } else {
	        foreach ($datos as $key => $value) {
	          $cadena  = $cadena . '
	            
	              <a href="' . '../archivos/actividad/' . $value['nombre'] . '" target="_blank" download="'. $value['nombre_original'] .'">
	                <i class="fas fa-file-alt" style="font-size:40px;color:#138496;"></i>
	              </a>
	              <i class="fas fa-trash-alt" style="position: absolute;margin: -10px 0 0 0px; color:#C82333;cursor:pointer;" 
	                onclick="eliminarArchivoFI('.$value['id_archivos_actividadEA'].')">
	              </i>
	          
	            ';
	        }
	      return $cadena;
	    }
  	}
  	public function existeArchivoFI($idEntregable,$FI) {
	    $sql="SELECT * from t_archivos_actividadea where id_entregable='$idEntregable' and id_act_fue_inf=1";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $cuenta=$query->rowCount();
	    if ($cuenta > 0) {
	      return "existeA";
	    } else {
	      return "noexisteA";
	    }
	    $query->close();
	}
		// AE
	public function agregarDatosArchivosAE($datos) {
	    $sql      = "INSERT INTO   t_archivos_actividadea (id_entregable,
	    													nombre,
	    													ruta,
	    													tipo,
	    													ext,
	    													nombre_original,
	    													id_act_mat_apoyo,
	    													id_act_fue_inf,
	    													id_act_ent,
	    													id_act_ap)
		                 VALUES (:id_entregable,
		                 		 :nombre,
		                 		 :ruta,
		                 		 :tipo,
		                 		 :ext,
		                 		 :original,
		                 		 :id_act_mat_apoyo,
		                 		 :id_act_fue_inf,
		                 		 :id_act_ent,
		                 		 :id_act_ap)";
	    $con   = Conexion::conectar();
		$query = $con->prepare($sql);
	    $query->bindParam(":id_entregable", $datos['id_entregable'],PDO::PARAM_INT);
	    $query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
	    $query->bindParam(":ruta", $datos['ruta'],PDO::PARAM_STR);
	    $query->bindParam(":tipo", $datos['tipo'],PDO::PARAM_STR);
	    $query->bindParam(":ext", $datos['ext'],PDO::PARAM_STR);
	    $query->bindParam(":original", $datos['original'],PDO::PARAM_STR);
	    $query->bindParam(":id_act_mat_apoyo", $datos['id_act_mat_apoyo'],PDO::PARAM_INT);
	    $query->bindParam(":id_act_fue_inf", $datos['id_act_fue_inf'],PDO::PARAM_INT);
	    $query->bindParam(":id_act_ent", $datos['id_act_ent'],PDO::PARAM_INT);
	    $query->bindParam(":id_act_ap", $datos['id_act_ap'],PDO::PARAM_INT);
	    $result = $query->execute();
	    if ($result) {
	    	return $datos['id_entregable'];
	    } else {
	    	return 0;
	    }
	    $query->close();
  	}
  	public function obtenerArchivoAE($idEntregable,$AE) {
	    $sql      = "SELECT id_archivos_actividadEA,
	                        nombre,
	                        ruta,
	                        tipo,
	                        nombre_original
	                  FROM  t_archivos_actividadea
	                 WHERE  id_entregable='$idEntregable' and id_act_ent ='$AE'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $datos = $query->fetchAll();
	    $cadena  = "";
	    if ($query->rowCount() == 0) {
	        $cadena = $cadena . '
	          <i class="fas fa-exclamation-circle" style="color:#D73925;position: absolute;
	          margin: 5px 0 0 -16px; font-size: 30px;"></i>';
	      return $cadena;
	    } else {
	        foreach ($datos as $key => $value) {
	          $cadena  = $cadena . '
	            
	              <a href="' . '../archivos/actividad/' . $value['nombre'] . '" target="_blank" download="'. $value['nombre_original'] .'">
	                <i class="fas fa-file-alt" style="font-size:40px;color:#138496;"></i>
	              </a>
	              <i class="fas fa-trash-alt" style="position: absolute;margin: -10px 0 0 0px; color:#C82333;cursor:pointer;" 
	                onclick="eliminarArchivoAE('.$value['id_archivos_actividadEA'].')">
	              </i>
	          
	            ';
	        }
	      return $cadena;
	    }
  	}
  	public function existeArchivoAE($idEntregable,$AE) {
	    $sql="SELECT * from t_archivos_actividadea where id_entregable='$idEntregable' and id_act_ent=1";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $cuenta=$query->rowCount();
	    if ($cuenta > 0) {
	      return "existeA";
	    } else {
	      return "noexisteA";
	    }
	    $query->close();
	}
		// AE
	public function agregarDatosArchivosAA($datos) {
	    $sql      = "INSERT INTO   t_archivos_actividadea (id_entregable,
	    													nombre,
	    													ruta,
	    													tipo,
	    													ext,
	    													nombre_original,
	    													id_act_mat_apoyo,
	    													id_act_fue_inf,
	    													id_act_ent,
	    													id_act_ap)
		                 VALUES (:id_entregable,
		                 		 :nombre,
		                 		 :ruta,
		                 		 :tipo,
		                 		 :ext,
		                 		 :original,
		                 		 :id_act_mat_apoyo,
		                 		 :id_act_fue_inf,
		                 		 :id_act_ent,
		                 		 :id_act_ap)";
	    $con   = Conexion::conectar();
		$query = $con->prepare($sql);
	    $query->bindParam(":id_entregable", $datos['id_entregable'],PDO::PARAM_INT);
	    $query->bindParam(":nombre", $datos['nombre'],PDO::PARAM_STR);
	    $query->bindParam(":ruta", $datos['ruta'],PDO::PARAM_STR);
	    $query->bindParam(":tipo", $datos['tipo'],PDO::PARAM_STR);
	    $query->bindParam(":ext", $datos['ext'],PDO::PARAM_STR);
	    $query->bindParam(":original", $datos['original'],PDO::PARAM_STR);
	    $query->bindParam(":id_act_mat_apoyo", $datos['id_act_mat_apoyo'],PDO::PARAM_INT);
	    $query->bindParam(":id_act_fue_inf", $datos['id_act_fue_inf'],PDO::PARAM_INT);
	    $query->bindParam(":id_act_ent", $datos['id_act_ent'],PDO::PARAM_INT);
	    $query->bindParam(":id_act_ap", $datos['id_act_ap'],PDO::PARAM_INT);
	    $result = $query->execute();
	    if ($result) {
	    	return $datos['id_entregable'];
	    } else {
	    	return 0;
	    }
	    $query->close();
  	}
  	public function obtenerArchivoAA($idEntregable,$AA) {
	    $sql      = "SELECT id_archivos_actividadEA,
	                        nombre,
	                        ruta,
	                        tipo,
	                        nombre_original
	                  FROM  t_archivos_actividadea
	                 WHERE  id_entregable='$idEntregable' and id_act_ap ='$AA'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $datos = $query->fetchAll();
	    $cadena  = "";
	    if ($query->rowCount() == 0) {
	        $cadena = $cadena . '
	          <i class="fas fa-exclamation-circle" style="color:#D73925;position: absolute;
	          margin: 5px 0 0 -16px; font-size: 30px;"></i>';
	      return $cadena;
	    } else {
	        foreach ($datos as $key => $value) {
	          $cadena  = $cadena . '
	            
	              <a href="' . '../archivos/actividad/' . $value['nombre'] . '" target="_blank" download="'. $value['nombre_original'] .'">
	                <i class="fas fa-file-alt" style="font-size:40px;color:#138496;"></i>
	              </a>
	              <i class="fas fa-trash-alt" style="position: absolute;margin: -10px 0 0 0px; color:#C82333;cursor:pointer;" 
	                onclick="eliminarArchivoAA('.$value['id_archivos_actividadEA'].')">
	              </i>
	          
	            ';
	        }
	      return $cadena;
	    }
  	}
  	public function existeArchivoAA($idEntregable,$AA) {
	    $sql="SELECT * from t_archivos_actividadea where id_entregable='$idEntregable' and id_act_ap=1";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $cuenta=$query->rowCount();
	    if ($cuenta > 0) {
	      return "existeA";
	    } else {
	      return "noexisteA";
	    }
	    $query->close();
	}
		// eliminar archivos
	public function eliminarArchivo($idArchivo) {
	    $sql      = "SELECT nombre,ruta FROM t_archivos_actividadea 
	    			  where id_archivos_actividadEA='$idArchivo'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $datos = $query->fetch();
	    if (file_exists("../../../archivos/actividad/" . $datos['nombre'])) {
	      if (unlink("../../../archivos/actividad/" . $datos['nombre'])) {
	          return 1;
	      } else {
	          return 0;
	      }
	    } else {
	      return 0;
	    }
  	}
  	public function eliminarDatosArchivo($idArchivo) {
		$sql = "DELETE FROM t_archivos_actividadea  where id_archivos_actividadEA=:idArchivo";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":idArchivo", $idArchivo, PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
	public function eliminarDatosArchivoCompetencia($idEntregable) {
		$sql = "DELETE FROM t_archivos_actividadea  where id_entregable=:idEntregable";
		$query = Conexion::conectar()->prepare($sql);
		$query->bindParam(":idEntregable", $idEntregable, PDO::PARAM_INT);
		return $query->execute();
		$query->close();
	}
	public function eliminarArchivosEntregable($idEntregable) {
	    $sql      = "SELECT id_archivos_actividadEA 
	    			   FROM t_archivos_actividadea 
	    			  where id_entregable = '$idEntregable'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $datos = $query->fetchAll();
	    foreach ($datos as $key => $value) {
	    	$result = self::eliminarArchivoCompetencia($value['id_archivos_actividadEA']);
        }
        return 1;
  	}
  	public function eliminarArchivoCompetencia($idArchivo) {
	    $sql      = "SELECT nombre,ruta FROM t_archivos_actividadea 
	    			  where id_archivos_actividadEA='$idArchivo'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $datos = $query->fetch();
	    if (file_exists("../../archivos/actividad/" . $datos['nombre'])) {
	      if (unlink("../../archivos/actividad/" . $datos['nombre'])) {
	          return 1;
	      } else {
	          return 0;
	      }
	    } else {
	      return 0;
	    }
  	}
  	public function obtenerIdEntregable($idArchivo) {
	    $sql      = "SELECT id_entregable FROM t_archivos_actividadea 
	    			  where id_archivos_actividadEA='$idArchivo'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $datos = $query->fetch();
	    return $datos[0];
  	}
  	public function obtenerIdEntregableCompetencia($idCompetencia) {
	    $sql      = "SELECT id_entregable FROM t_entregable 
	    			  where id_competencia='$idCompetencia'";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->execute();
	    $datos = $query->fetch();
	    return $datos[0];
  	}
  	public function eliminarDatos($id_entregable,$id_competencia) {
		$sql = "DELETE FROM t_desempeno where id_entregable=:id_entregable";
	    $query = Conexion::conectar()->prepare($sql);
	    $query->bindParam(":id_entregable", $id_entregable, PDO::PARAM_INT);
	    if ($query->execute()) {
	    	$sql = "DELETE FROM t_evidencia where id_entregable=:id_entregable";
		    $query = Conexion::conectar()->prepare($sql);
		    $query->bindParam(":id_entregable", $id_entregable, PDO::PARAM_INT);
		    if ($query->execute()) {
		    	$sql = "DELETE FROM t_entregable where id_entregable=:id_entregable";
			    $query = Conexion::conectar()->prepare($sql);
			    $query->bindParam(":id_entregable", $id_entregable, PDO::PARAM_INT);
			    if ($query->execute()) {
			    	$sql = "DELETE FROM t_asignatura_competencia where id_competencia=:id_competencia";
				    $query = Conexion::conectar()->prepare($sql);
				    $query->bindParam(":id_competencia", $id_competencia, PDO::PARAM_INT);
				    if ($query->execute()) {
				    	if ($query->execute()) {
					    	$sql = "DELETE FROM t_competencia where id_competencia=:id_competencia";
						    $query = Conexion::conectar()->prepare($sql);
						    $query->bindParam(":id_competencia", $id_competencia, PDO::PARAM_INT);
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
}

?>