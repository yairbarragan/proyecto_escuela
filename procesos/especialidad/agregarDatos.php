<?php
require_once "../../clases/Especialidad.php";
$obj = new Especialidad(); //creo mi objeto
$datos = array(
	'nombre'           => $_POST['nombre'],
	'periodo_vigencia' => $_POST['periodo_vigencia'],
);
//print_r($datos);
$respuesta = $obj->insertarDatos($datos);
if ($respuesta > 0) {
	$datos = array (
		'id_carrera'      => $_POST['id_carrera'],
		'id_especialidad' => $respuesta,
	);
	//print_r($datos);
	if ($obj->insertarDatosCarreraEspecialidad($datos)) {
		echo 1;
	} else {
		echo 0;
	}
} else {
	echo 0;
}
