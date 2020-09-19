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

}

?>