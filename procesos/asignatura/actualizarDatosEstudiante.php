<?php
require_once "../../clases/Asignatura.php";
$obj = new Asignatura(); //creo mi objeto

$id_estudiante = $_POST['id_estudianteU'];
$calificacion  = $_POST['calif'];
$datos         = array(
	'id_estudiante' => $id_estudiante,
	'calificacion'  => $calificacion,
);
//print_r($datos);
echo $obj->actualizarDatosEstudiante($datos);