<?php
require_once "../../clases/Proyecto.php";
$obj = new Proyecto(); //creo mi objeto

$id = $_POST['id'];
echo json_encode($obj->obtenerDatos($id));