<?php
require_once "../../clases/Proyecto.php";
$obj = new Proyecto(); //creo mi objeto

$id = $_POST['id'];
$idP = $_POST['idP'];

echo $obj->eliminarProyectoAsignatura($id,$idP);



