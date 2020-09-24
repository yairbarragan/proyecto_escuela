<?php
require_once "../../clases/Especialidad.php";
$obj             = new Especialidad(); //creo mi objeto
$nombre          = $_POST['nombreU'];
$periodo         = $_POST['periodo_vigenciaU'];
$id_carrera      = $_POST['id_carreraU'];
$id_especialidad = $_POST['id_especialidad'];

$datos = array(
	'nombre'           => $nombre,
	'periodo_vigencia' => $periodo,
	'id_especialidad'  => $id_especialidad,
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
