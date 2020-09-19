<?php

require_once "Conexion.php";

class Especialidad extends Conexion {

	public function mostrarDatos() {
		$sql = "SELECT especialidad.id_especialidad,
					   especialidad.periodo_vigencia
				  FROM t_cat_especialidad as especialidad
				  ";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}

}

?>