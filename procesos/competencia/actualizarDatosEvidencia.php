<?php
require_once "../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto
// comprobar asignatura en t_competencia_asignatura
// agregar en t_competencia y t_asignatura_competencia --> lastid de t_competencia

$id_entregable = $_POST['id_entregableE'];
$datos         = array(
	'url'           => $_POST['url'],
	'descripcionE'  => $_POST['descripcionE'],
	'puntos'        => $_POST['puntos'],
	'descripcionD'  => $_POST['descripcionD'],
	'id_entregable' => $id_entregable,
);

if ($obj->actualizarEvidencia($datos)) {
	echo $obj->actualizarDesempeno($datos);
} else {
	echo 0;
}