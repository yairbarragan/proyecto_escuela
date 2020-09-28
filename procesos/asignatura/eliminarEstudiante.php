<?php
require_once "../../clases/Asignatura.php";
$obj = new Asignatura(); //creo mi objeto

$id_estudiante = $_POST['id'];
$idAsig = $_POST['idAsig'];

echo $obj->eliminarEstudiante($id_estudiante,$idAsig);

