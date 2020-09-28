<?php
require_once "../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto

$id_competencia = $_POST['id'];
echo json_encode($obj->obtenerDatos($id_competencia));
