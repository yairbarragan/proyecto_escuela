<?php
require_once "../../clases/Especialidad.php";
$obj = new Especialidad(); //creo mi objeto

$id = $_POST['id'];
echo json_encode($obj->obtenerDatos($id));