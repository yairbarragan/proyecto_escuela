<?php
require_once "../../clases/Carrera.php";
$obj = new Carrera(); //creo mi objeto

$datos = array(
	'nombre' => $_POST['nombre'],
	'clave'  => $_POST['clave'],
);
$respuesta = $obj->insertarDatos($datos);
if ($respuesta === "existe") {
	echo 2;
}else if ($respuesta) {
	echo 1;
}else {
	echo 0;
}
