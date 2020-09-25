<?php
require_once "../../clases/Asignatura.php";
$obj = new Asignatura(); //creo mi objeto

$id_asignatura = $_POST['id'];
// eliminar t_asignatura_proyecto
// eliminar t_asignatura_competencia
// eliminar t_asignatura_estudiante
// eliminar t_area_aplicacion
// eliminar t_aasignatura_carrera
// eliminar t_asignatura
echo $obj->eliminarDatos($id_asignatura);

