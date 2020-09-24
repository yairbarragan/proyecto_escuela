<?php

require_once "Conexion.php";

class Asignatura extends Conexion {

	public function mostrarDatos() {
		$sql = "SELECT asignatura.id_asignatura,
					   asignatura.nombre,
					   asignatura.clave,
					   asignatura.creditos,
					   carrera.nombre as carNombre
				  FROM t_asignatura as asignatura
			INNER JOIN t_cat_carrera as carrera
            INNER JOIN t_asignatura_carrera as asigCarrera on carrera.id_carrera=asigCarrera.id_carrera;
				  ";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}

	public function mostrarDatosEstudiante() {
		$sql = "SELECT est.id_estudiante,
					   usu.nombre,
					   est.no_control
				  FROM t_estudiante as est
			INNER JOIN t_usuario as usu;";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}

}

?>