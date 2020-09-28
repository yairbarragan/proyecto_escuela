<?php
require_once "../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto

$id = $_POST['id'];
echo json_encode($obj->obtenerDatosDesempeno($id));
