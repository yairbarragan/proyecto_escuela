<?php
require_once "../../clases/Proyecto.php";
$obj = new Proyecto(); //creo mi objeto

$id = $_POST['idArchivo'];

if ($obj->eliminarArchivo($id)) {
	echo $obj->eliminarDatosArchivo($id);
} else {
	echo 0;
}
?>