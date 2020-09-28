<?php

require_once "Conexion.php";

class Estudiante extends Conexion {

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
	public function obtenerIdEstudiante($idUsuario) {
		$sql = "SELECT id_estudiante
				  from t_estudiante where id_usuario = '$idUsuario'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetch()[0];
		$query->close();
	}
	public function obtenerNombreAsignatura($idEstudiante) {
		$sql = "SELECT asi.nombre,
					   asiEst.calif
				  from t_asignatura as asi
 			inner join t_asignatura_estudiante as asiEst on asi.id_asignatura = asiest.id_asignatura
				   and id_estudiante = '$idEstudiante'";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchALL();
		$query->close();
	}
	public function mostrarDatosProyecto($idEstudiante) {
		$sql = "SELECT pro.titulo, 
					   pro.nombre,
				       pro.area_aplicacion,
				       pro.id_proyecto,
				       usuario.nombre as nom
				  from t_proyecto as pro 
			inner join t_proyecto_estudiante as proEst on pro.id_proyecto = proEst.id_proyecto
			inner join t_asesor as asesor on pro.id_asesor = asesor.id_asesor
			inner join t_usuario as usuario on asesor.id_usuario = usuario.id_usuario
				   and proEst.id_estudiante = '$idEstudiante'";
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