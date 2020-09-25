<?php
require_once "../../clases/Asignatura.php";
$obj = new Asignatura(); //creo mi objeto

$datos = array(
	'id_estudiante'     => $_POST['id_estudiante'],
	'id_asignatura'     => $_POST['id_asignatura'],
);
//print_r($datos);
//echo $obj->insertarEstudiante($datos);
if ($obj->existeEstudiante($datos['id_estudiante'])) {
	echo 2;
} else {
	echo $obj->insertarEstudiante($datos);
}