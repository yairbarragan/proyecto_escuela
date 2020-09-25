<?php
require_once "../../clases/Asignatura.php";
$obj = new Asignatura(); //creo mi objeto

$datos = array(
	'nombre'        => $_POST['nombre_asig'],
	'aportacion'    => $_POST['aportacion'],
	'nodo_problema' => $_POST['nodo_problema'],
	'id_asignatura' => $_POST['id_asignaturaA'],
);
//print_r($datos);
echo $obj->actualizarAreaAplicacion($datos);
