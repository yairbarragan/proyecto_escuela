<?php

require_once "Conexion.php";

class Asesor extends Conexion {

	public function mostrarDatos($idUsuario) {
		$sql = "SELECT usuario.nombre,
					   usuario.usuario,
					   usuario.id_usuario
		from t_usuario as usuario where id_usuario = '$idUsuario'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}
	public function obtenerIdAsesor($idUsuario) {
		$sql = "SELECT id_asesor
				  from t_asesor where id_usuario = '$idUsuario'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetch()[0];
		$query->close();
	}
	public function obtenerNombreCarrera($idAsesor) {
		$sql = "SELECT carrera.nombre,
					   carrera.clave
				  from t_cat_carrera as carrera
 			inner join t_asesor as asesor on carrera.id_carrera = asesor.id_carrera
				   and id_asesor = '$idAsesor'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchALL();
		$query->close();
	}
	public function mostrarDatosProyecto($idAsesor) {
		$sql = "SELECT pro.titulo, 
					   pro.nombre,
				       pro.area_aplicacion,
				       pro.id_proyecto,
				       usuario.nombre as nom
				  from t_proyecto as pro 
			inner join t_asesor as asesor on pro.id_asesor = asesor.id_asesor
			inner join t_usuario as usuario on asesor.id_usuario = usuario.id_usuario
				   and asesor.id_asesor = '$idAsesor'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchALL();
		$query->close();
	}
	public function obtenerDatosEstudiante($idProyecto) {
		$sql = "SELECT usuario.nombre as nom
				  from t_proyecto as pro 
			inner join t_proyecto_estudiante as proEst on pro.id_proyecto = proEst.id_proyecto
            inner join t_estudiante as est on proEst.id_estudiante = est.id_estudiante
			inner join t_usuario as usuario on est.id_usuario = usuario.id_usuario
				   and pro.id_proyecto = '$idProyecto'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetch()[0];
		$query->close();
	}

	public function obtenerIdProyecto($idAsesor) {
		$sql = "SELECT id_proyecto
				  from t_proyecto where id_asesor = '$idAsesor'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetch()[0];
		$query->close();
	}
	public function mostrarMateriasProyecto($idProyecto) {
		$sql = "SELECT asi.nombre,asi.clave 
				  from t_asignatura as asi  
			inner join t_proyecto_asignatura as proAsi on asi.id_asignatura = proAsi.id_asignatura
				   and id_proyecto='$idProyecto'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchALL();
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
	          <i class="fas fa-exclamation-circle" style="color: #D73925;
    		position: absolute;
    		margin: -11px 0 0 -14px;
    		font-size: 24px;"></i>';
	      return $cadena;
	    } else {
	        foreach ($datos as $key => $value) {
	          $cadena  = $cadena . '
	            
	              <a href="' . '../archivos/' . $value['nombre'] . '" target="_blank" download="'. $value['nombre_original'] .'">
	                <i class="fas fa-file-alt" style="font-size:40px;color:#138496;"></i>
	              </a>
	          
	            ';
	        }
	      return $cadena;
	    }
  	}
}

?>