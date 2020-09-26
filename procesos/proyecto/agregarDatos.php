<?php
require_once "../../clases/Proyecto.php";
$obj = new Proyecto(); //creo mi objeto

$id_estudiante = $_POST['id_estudiante'];
$id_asesor     = $_POST['id_asesor'];
$datos         = array(
	'nombre'          => $_POST['nombre'],
	'titulo'          => $_POST['titulo'],
	'area_aplicacion' => $_POST['area_aplicacion'],
	'id_estudiante'   => $id_estudiante,
	'id_asesor'       => $id_asesor,
);
$asesor     = $obj->buscarAsesorProyecto($id_asesor);
$estudiante = $obj->buscarEstudianteProyecto($id_estudiante);

if ($asesor == "noexisteA" and $estudiante == "noexisteE") {
	//echo "asesor y estudiante no existen, introduce todo";
	$result = $obj->insertarDatosProyecto($datos);
	if ($result['execute']) {
		echo $obj->insertarProyectoEstudiante($id_estudiante,$result['lastID']);
	} else {
		echo 0;
	}

} else if ($asesor != "noexisteA" and $estudiante == "noexisteE") {
	//echo "asesor existe y estudiante no existe";
	echo "A"; //asesor ya esta registrados en un proyecto

} else if ($asesor == "noexisteA" and $estudiante != "noexisteE") {
	//echo "asesor no existe y estudiante si existe";
	echo "E"; //estudiante ya esta registrados en un proyecto

} else if ($asesor != "noexisteA" and $estudiante != "noexisteE") {
	//echo "asesor existe y estudiante existe";
	echo "AE"; //el asesor y estudiante ya estan registrados en un proyecto

} else {
	echo 0;
}
