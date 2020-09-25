<?php
require_once "../../clases/Asignatura.php";
$obj = new Asignatura(); //creo mi objeto

$id_estudiante = $_POST['id'];
echo json_encode($obj->obtenerDatosEstudiante($id_estudiante));
