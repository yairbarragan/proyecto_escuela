<?php
require_once "../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto
// comprobar asignatura en t_competencia_asignatura
// agregar en t_competencia y t_asignatura_competencia --> lastid de t_competencia

$id_asignatura  = $_POST['id_asignaturaU'];
$id_competencia = $_POST['id_competencia'];
$datos          = array(
	'nombre'              => $_POST['nombreU'],
	'campo_desar_asig'    => $_POST['campo_desar_asigU'],
	'campo_desar_proyint' => $_POST['campo_desar_proyintU'],
	'id_competencia'	  => $id_competencia,
	'id_asignatura'		  => $id_asignatura,
);

$iguales =$obj->buscarAsignaturaCompetencia($id_competencia,$id_asignatura);
$existeA = $obj->existeAsignatura($id_asignatura);
if ($iguales == "iguales") {
	echo $obj->actualizarDatos($datos);
} else {
	if ($existeA == "existeA") {
		echo 2;
	} else {
		if ($obj->actualizarAsignatura($datos)) {
			echo $obj->actualizarDatos($datos);
		} else {
			echo 0;
		}
	}
} 