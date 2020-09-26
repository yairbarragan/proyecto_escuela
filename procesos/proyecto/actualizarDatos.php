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
);

$resultA  = $obj->buscarAsesor($idAse,$idPro);
$resultE = $obj->buscarEstudiante($idEst,$idPro);


if ($resultA == "mismoA" and $resultE == "mismoE") {
	echo "asesor y estudiante iguales";
}