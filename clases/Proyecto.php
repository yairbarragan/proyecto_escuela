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

}// ./ end class

?>