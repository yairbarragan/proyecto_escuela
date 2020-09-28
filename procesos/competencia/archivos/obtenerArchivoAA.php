<?php 
require_once "../../../clases/Competencia.php";
$obj   = new Competencia(); //creo mi objeto

$id = $_POST['id'];
$AA = 1;
echo $obj->obtenerArchivoAA($id,$AA); //creo mi nueva instancia
	
 ?>