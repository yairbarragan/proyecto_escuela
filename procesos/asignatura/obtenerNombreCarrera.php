<?php
require_once "../../clases/Asignatura.php";
$obj = new Asignatura(); //creo mi objeto

$id_asignatura_carrera = $_POST['id'];
echo $obj->obtenerCarrera($id_asignatura_carrera);