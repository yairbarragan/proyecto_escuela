<?php
require_once "../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto
// comprobar asignatura en t_competencia_asignatura
// agregar en t_competencia y t_asignatura_competencia --> lastid de t_competencia

$id_entregable = $_POST['id_entregable'];
$datos         = array(
	'entregable'    => $_POST['entregable'],
	'descripcion'   => $_POST['descripcion'],
	'id_entregable' => $id_entregable,
);
echo $obj->actualizarDatosEntregable($datos);