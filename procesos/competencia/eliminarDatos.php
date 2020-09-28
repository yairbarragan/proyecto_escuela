<?php
require_once "../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto


// eliminar competencia 
//unlink archivos --> t_archivos_actividad --> t_desempe --> t_eviden --> t_entrega --> t_competencia

$id_competencia = $_POST['idCompetencia'];
// buscar id_entregable de id competencia
$id_entregable  = $obj->obtenerIdEntregableCompetencia($id_competencia);

if($obj->eliminarArchivosEntregable($id_entregable)) {
	if($obj->eliminarDatosArchivoCompetencia($id_entregable)){
		echo $obj->eliminarDatos($id_entregable,$id_competencia);
	} else {
		echo 0;
	}
} else {
	echo 0;
}
?>