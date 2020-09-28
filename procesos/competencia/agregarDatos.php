<?php
require_once "../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto
// comprobar asignatura en t_competencia_asignatura 
// agregar en t_competencia y t_asignatura_competencia --> lastid de t_competencia

$id_asignatura = $_POST['id_asignatura'];
$datos         = array(
	'nombre'              => $_POST['nombre'],
	'campo_desar_asig'    => $_POST['campo_desar_asig'],
	'campo_desar_proyint' => $_POST['campo_desar_proyint'],
);
//print_r($datos);
$existeC = $obj->existeAsignatura($id_asignatura);

if ($existeC == "existeA") {
	echo 2;
} else {
	$lastIdCompetencia = $obj->insertarDatos($datos);
	if ($lastIdCompetencia > 0) {
		$result = $obj->insertarIdAsignatura($lastIdCompetencia,$id_asignatura);
		if ($result) {
			$lastidEntregable = $obj->insertarIdEntregable($lastIdCompetencia);
			if ($lastidEntregable > 0) {
				if ($obj->insertarEvidencia($lastidEntregable)) {
					echo $obj->insertarDesempeno($lastidEntregable);
				} else {
					echo 0;
				}
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	} else {
		echo 0;
	}	
}


