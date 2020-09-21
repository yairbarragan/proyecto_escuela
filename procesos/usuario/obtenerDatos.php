<?php
require_once "../../clases/Usuario.php";
$obj = new Usuario(); //creo mi objeto

$id = $_POST['id'];
echo json_encode($obj->obtenerDatos($id));