<?php 
require_once "../../clases/Proyecto.php";
$obj   = new Proyecto(); //creo mi objeto

$id = $_POST['idProyecto'];
echo $obj->obtenerArchivo($id); //creo mi nueva instancia
	
 ?>