<?php
require_once "../../clases/Carrera.php";
$obj = new Carrera(); //creo mi objeto

$id = $_POST['id'];

echo $obj->eliminarDatos($id);