<?php
require_once "../../clases/Proyecto.php";
$obj = new Proyecto(); //creo mi objeto

$id_proyecto   = $_POST['id_proyectoM'];
$id_asignatura = $_POST['id_asignaturaM'];

if ($obj->existeMateria($id_asignatura,$id_proyecto) == "existeA") {
	echo "A";
} else {
	echo $obj->insertarDatosMateria($id_proyecto, $id_asignatura);
}


