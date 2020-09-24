<?php
require_once "../../clases/Asignatura.php";
$obj = new Asignatura(); //creo mi objeto

$datos = array(
	'nombre'     => $_POST['nombre'],
	'clave'      => $_POST['clave'],
	'creditos'   => $_POST['creditos'],
	'id_carrera' => $_POST['id_carrera'],
);
$respuesta = $obj->insertarDatos($datos);

if ($respuesta === "existe") {
	echo 2;
} else if ($respuesta > 0) {
	$id_asignatura = $respuesta;
	$datos         = array(
		'id_asignatura' => $id_asignatura,
		'id_carrera'    => $_POST['id_carrera'],
	);
	if ($obj->insertarAreaAplicacion($id_asignatura)) {
		echo $obj->insertarAsignaturaCarrera($datos);
	} else {
		echo 0;
	}
} else {
	echo 0;
}
