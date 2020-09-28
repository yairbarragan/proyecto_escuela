<?php
require_once "../../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto

$idEntregable = $_POST['id_entregableM'];
$AE           = 1;
$existe       = $obj->existeArchivoAE($idEntregable, $AE);
if ($existe == "existeA") {
  echo "E";
} else {
  $nombre             = $_FILES['actAE']['name'];
  $nombreOriginal     = $_FILES['actAE']['name'];
  $rutaAlmacenamiento = $_FILES['actAE']['tmp_name'];
  $carpeta            = '../../../archivos/actividad/';
  $rutaFinal          = $carpeta . $nombre;
  if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {
    $ext1        = explode(".", $_FILES['actAE']['name']);
    $extension   = end($ext1);
    $hora        = date('His');
    $fechaInsert = date("Y-m-d");
    rename($rutaFinal, $carpeta . $fechaInsert . "-" . $hora . "-" . $idEntregable . "." . $extension);
    $nombre    = $fechaInsert . "-" . $hora . "-" . $idEntregable . "." . $extension;
    $rutaFinal = $carpeta . $fechaInsert . "-" . $hora . "-" . $idEntregable . "." . $extension;
    $actAE   = 1;
    $datos     = array(
      'id_entregable'    => $idEntregable,
      'nombre'           => $nombre,
      'ruta'             => $rutaFinal,
      'tipo'             => "archivo",
      'ext'              => $extension,
      'original'         => $nombreOriginal,
      'id_act_ent'       => $actAE,
    );
    $idEnt = $obj->agregarDatosArchivosAE($datos);
    if ($idEnt > 0) {
      echo $idEnt;
    } else {
      echo 0;
    }
  }
}
