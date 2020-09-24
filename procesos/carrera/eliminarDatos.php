<?php
require_once "../../clases/Carrera.php";
$obj = new Carrera(); //creo mi objeto

$id_carrera = $_POST['id'];

if ($obj->eliminarCarreraAsesor($id_carrera)) {
	if ($obj->eliminarCarreraEspecialidad($id_carrera)) {
		if ($obj->eliminarAsignaturaCarrera($id_carrera)) {
			if ($obj->eliminarDatos($id_carrera)) {
				echo 1;
			} else {
				//echo "eliminar datos";
				echo 0;
			}
		} else {
			//echo "carrera asignatura";
			echo 0;
		}
	} else {
		//echo "carrera especialidad";
		echo 0;
	}
} else {
	//echo "carrera asesor";
	echo 0;
}



