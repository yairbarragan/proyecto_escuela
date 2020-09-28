<?php
require_once "../../clases/Proyecto.php";
$obj   = new Proyecto(); //creo mi objeto
$idEst = $_POST['id_estudianteU'];
$idAse = $_POST['id_asesorU'];
$idPro = $_POST['id_proyecto'];

$datos = array(
	'nombre'          => $_POST['nombreU'],
	'titulo'          => $_POST['tituloU'],
	'area_aplicacion' => $_POST['area_aplicacionU'],
	'id_asesor'       => $idAse,
	'id_proyecto'     => $idPro,
);

$resultA = $obj->buscarAsesor($idAse, $idPro);
$resultE = $obj->buscarEstudiante($idEst, $idPro);

if ($resultA == "mismoA" and $resultE == "mismoE") {
	//echo "asesor y estudiante iguales --> actualizo datos";
	echo $obj->actualizarDatos($datos);

} else if ($resultA != "mismoA" and $resultE == "mismoE") {
	//echo "asesor diferente,  estudiante igual -- buscar asesor en t_proyecto update t_proyecto asesor ";
	if ($obj->existeAsesor($idAse) == "noexisteA") {
		echo $obj->actualizarDatos($datos);
	} else {
		echo "A";
	}

} else if ($resultA == "mismoA" and $resultE != "mismoE") {
	//echo "asesor igual,  estudiante diferente -- buscar est en t_proyecto_estudiante insertar est ";
	if ($obj->existeEstudiante($idEst) == "noexisteE") {
		if ($obj->eliminarProyectoEstudiante($idPro)) {
			if ($obj->insertarProyectoEstudiante($idEst, $idPro)) {
				echo $obj->actualizarDatos($datos);
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	} else {
		echo "E";
	}

} else if ($resultA != "mismoA" and $resultE != "mismoE") {
	//echo "asesor y estudiante diferentes -- buscar as y es update e insert";

	$existeA = $obj->existeAsesor($idAse);
	$existeE = $obj->existeEstudiante($idEst);
	if ($existeA == "existeA" and $existeE == "existeE") {
		echo "EA";
	} else if ($existeA != "existeA" and $existeE == "existeE") {
		echo "E";
	} else if ($existeA == "existeA" and $existeE != "existeE") {
		echo "A";
	} else if ($existeA != "existeA" and $existeE != "existeE") {
		//echo "no existen";
		if ($obj->eliminarProyectoEstudiante($idPro)) {
			if ($obj->insertarProyectoEstudiante($idEst, $idPro)) {
				echo $obj->actualizarDatos($datos);
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