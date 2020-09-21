<?php
require_once "../../clases/Carrera.php";
$obj        = new Carrera(); //creo mi objeto
$clave      = $_POST['claveU'];
$id_carrera = $_POST['id_carrera'];
$nombre     = $_POST['nombreU'];

$datos = array(
	'id_carrera' => $id_carrera,
	'nombre'     => $nombre,
	'clave'      => $clave,
);

$res = $obj->buscarClaveUpdate($clave, $id_carrera);
if ($res === 'igual') {
	//echo "actualizo nombre";
	if ($obj->actualizarDatosNombre($datos)) {
		echo 1;
	} else {
		echo 0;
	}
} else if ($res === 1) {
	//echo "existe clave";
	echo 2;
} else {
	//echo "actualizo nombre y clave";
	if ($obj->actualizarDatos($datos)) {
		echo 1;
	}else {
		echo 0;
	}
}