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

	public function mostrarDatosEntregable() {
		$sql = "SELECT ent.id_entregable,
					   ent.url,
					   ent.descripcion
		from t_entregable as ent";
		$query = Conexion::conectar()->prepare($sql);
		$query->execute();
		return $query->fetchAll();
		$query->close();
	}

}

?>