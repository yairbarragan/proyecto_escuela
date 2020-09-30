<?php
require_once "../../clases/Asignatura.php";
$obj = new Asignatura(); //creo mi objeto

$id_estudiante = $_POST['id_estudianteU'];
$calificacion  = $_POST['calif'];
$id_asignatura = $_POST['idAsigE'];
$datos         = array(
	'id_estudiante' => $id_estudiante,
	'calificacion'  => $calificacion,
	'id_asignatura' => $id_asignatura,
);
//print_r($datos);
echo $obj->actualizarDatosEstudiante($datos);
