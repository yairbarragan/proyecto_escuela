<?php 
require_once "../../../clases/Competencia.php";
$obj   = new Competencia(); //creo mi objeto

$id = $_POST['id'];
$FI = 1;
echo $obj->obtenerArchivoFI($id,$FI); //creo mi nueva instancia
	
 ?>