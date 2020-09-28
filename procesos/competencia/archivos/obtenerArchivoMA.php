<?php 
require_once "../../../clases/Competencia.php";
$obj   = new Competencia(); //creo mi objeto

$id = $_POST['id'];
$MA = 1;
echo $obj->obtenerArchivoMA($id,$MA); //creo mi nueva instancia
	
 ?>