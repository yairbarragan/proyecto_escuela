<?php
require_once "../../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto

$id = $_POST['idArchivo'];
$idEntregable = $obj->obtenerIdEntregable($id);

if ($obj->eliminarArchivo($id)) {
	if ($obj->eliminarDatosArchivo($id)) {
		echo $idEntregable;
	}
} else {
	echo 0;
}
?>