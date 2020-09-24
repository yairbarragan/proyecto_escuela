<?php
require_once "../../clases/Asignatura.php";
$obj = new Asignatura(); //creo mi objeto

$id_asignatura = $_POST['id'];
echo json_encode($obj->obtenerDatos($id_asignatura));
