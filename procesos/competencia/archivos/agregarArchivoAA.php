<?php
require_once "../../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto

$idEntregable = $_POST['id_entregableM'];
$AA           = 1;
$existe       = $obj->existeArchivoAA($idEntregable, $AA);
if ($existe == "existeA") {
  echo "E";
} else {
  $nombre             = $_FILES['actAA']['name'];
  $nombreOriginal     = $_FILES['actAA']['name'];
  $rutaAlmacenamiento = $_FILES['actAA']['tmp_name'];
  $carpeta            = '../../../archivos/actividad/';
  $rutaFinal          = $carpeta . $nombre;
  if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {
    $ext1        = explode(".", $_FILES['actAA']['name']);
    $extension   = end($ext1);
    $hora        = date('His');
    $fechaInsert = date("Y-m-d");
    rename($rutaFinal, $carpeta . $fechaInsert . "-" . $hora . "-" . $idEntregable . "." . $extension);
    $nombre    = $fechaInsert . "-" . $hora . "-" . $idEntregable . "." . $extension;
    $rutaFinal = $carpeta . $fechaInsert . "-" . $hora . "-" . $idEntregable . "." . $extension;
    $actAA   = 1;
    $datos     = array(
      'id_entregable'    => $idEntregable,
      'nombre'           => $nombre,
      'ruta'             => $rutaFinal,
      'tipo'             => "archivo",
      'ext'              => $extension,
      'original'         => $nombreOriginal,
      'id_act_ap'        => $actAA,
    );
    $idEnt = $obj->agregarDatosArchivosAA($datos);
    if ($idEnt > 0) {
      echo $idEnt;
    } else {
      echo 0;
    }
  }
}
