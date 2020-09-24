<?php
require_once "../../clases/Especialidad.php";
$obj = new Especialidad(); //creo mi objeto

$id_especialidad_carrera = $_POST['id'];
echo $obj->obtenerCarrera($id_especialidad_carrera);