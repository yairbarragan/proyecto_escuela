<?php
require_once "../../clases/Proyecto.php";
$obj = new Proyecto(); //creo mi objeto

$idProyecto = $_POST['id'];

if ($obj->eliminarArchivosProyecto($idProyecto)) {
    if ($obj->eliminarDatosArchivo($idProyecto)) {
	    echo $obj->eliminarDatos($idProyecto);
    } else {
    	echo 0;
    }
} else {
	echo 0;
}



