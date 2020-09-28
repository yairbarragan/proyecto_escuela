<?php 
require_once "../../../clases/Competencia.php";
$obj   = new Competencia(); //creo mi objeto

$id = $_POST['id'];
$AE = 1;
echo $obj->obtenerArchivoAE($id,$AE); //creo mi nueva instancia
	
 ?>