<?php
require_once "../../clases/Especialidad.php";
$obj             = new Especialidad(); //creo mi objeto
$nombre          = $_POST['nombreU'];
$periodo         = $_POST['periodo_vigenciaU'];
$periodo_dos     = $_POST['periodo_vigencia_dosU'];
$id_carrera      = $_POST['id_carreraU'];
$id_especialidad = $_POST['id_especialidad'];

$datos = array(
	'nombre'               => $nombre,
	'periodo_vigencia'     => $periodo,
	'periodo_vigencia_dos' => $periodo_dos,
	'id_especialidad'      => $id_especialidad,
);
//echo $obj->insertarDatosCarreraEspecialidad($datos);
//buscar id_carrera con id_especialidad

//echo $obj->buscarCarrera($id_especialidad);
if ($obj->buscarCarrera($id_especialidad)) {
	if ($obj->actualizarDatosEspecialidad($datos)) {
		$datos = array(
			'id_carrera'      => $id_carrera,
			'id_especialidad' => $id_especialidad,
		);
		if ($obj->actualizarDatosCarrera($datos)) {
			echo 1;
		} else {
			echo 0;
		}
	} else {
		echo 0;
	}
} else {
	$datos = array(
		'id_carrera'      => $id_carrera,
		'id_especialidad' => $id_especialidad,
	);
	if ($obj->insertarDatosCarreraEspecialidad($datos)) {
		$datos = array(
			'nombre'               => $nombre,
			'periodo_vigencia'     => $periodo,
			'periodo_vigencia_dos' => $periodo_dos,
			'id_especialidad'      => $id_especialidad,
		);
		if ($obj->actualizarDatosEspecialidad($datos)) {
			$datos = array(
				'id_carrera'      => $id_carrera,
				'id_especialidad' => $id_especialidad,
			);
			if ($obj->actualizarDatosCarrera($datos)) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	} else {
		echo 0;
	}
}
/**/
