<?php
require_once "../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto

$id_asignatura = $_POST['id'];
echo $obj->obtenerAsignatura($id_asignatura);