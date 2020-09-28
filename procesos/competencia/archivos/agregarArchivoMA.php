<?php
require_once "../../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto

$idEntregable = $_POST['id_entregableM'];
$MA           = 1;
$existe       = $obj->existeArchivoMA($idEntregable, $MA);
if ($existe == "existeA") {
  echo "E";
} else {
  $nombre = $_FILES['matApo']['name'];
  $nombreOriginal     = $_FILES['matApo']['name'];
  $rutaAlmacenamiento = $_FILES['matApo']['tmp_name'];
  $carpeta            = '../../../archivos/actividad/';
  $rutaFinal          = $carpeta . $nombre;
  if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {
    $ext1        = explode(".", $_FILES['matApo']['name']);
    $extension   = end($ext1);
    $hora        = date('His');
    $fechaInsert = date("Y-m-d");
    rename($rutaFinal, $carpeta . $fechaInsert . "-" . $hora . "-" . $idEntregable . "." . $extension);
    $nombre    = $fechaInsert . "-" . $hora . "-" . $idEntregable . "." . $extension;
    $rutaFinal = $carpeta . $fechaInsert . "-" . $hora . "-" . $idEntregable . "." . $extension;
    $matApoyo  = 1;
    $datos     = array(
      'id_entregable'    => $idEntregable,
      'nombre'           => $nombre,
      'ruta'             => $rutaFinal,
      'tipo'             => "archivo",
      'ext'              => $extension,
      'original'         => $nombreOriginal,
      'id_act_mat_apoyo' => $matApoyo,
    );
    $idEnt = $obj->agregarDatosArchivosMA($datos);
    if ($idEnt > 0) {
      echo $idEnt;
    } else {
      echo 0;
    }
  }
}
