<?php
require_once "../../../clases/Competencia.php";
$obj = new Competencia(); //creo mi objeto

$idEntregable = $_POST['id_entregableM'];
$FI           = 1;
$existe       = $obj->existeArchivoFI($idEntregable, $FI);
if ($existe == "existeA") {
  echo "E";
} else {
  $nombre             = $_FILES['fuenInf']['name'];
  $nombreOriginal     = $_FILES['fuenInf']['name'];
  $rutaAlmacenamiento = $_FILES['fuenInf']['tmp_name'];
  $carpeta            = '../../../archivos/actividad/';
  $rutaFinal          = $carpeta . $nombre;
  if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {
    $ext1        = explode(".", $_FILES['fuenInf']['name']);
    $extension   = end($ext1);
    $hora        = date('His');
    $fechaInsert = date("Y-m-d");
    rename($rutaFinal, $carpeta . $fechaInsert . "-" . $hora . "-" . $idEntregable . "." . $extension);
    $nombre    = $fechaInsert . "-" . $hora . "-" . $idEntregable . "." . $extension;
    $rutaFinal = $carpeta . $fechaInsert . "-" . $hora . "-" . $idEntregable . "." . $extension;
    $fuenInf   = 1;
    $datos     = array(
      'id_entregable'    => $idEntregable,
      'nombre'           => $nombre,
      'ruta'             => $rutaFinal,
      'tipo'             => "archivo",
      'ext'              => $extension,
      'original'         => $nombreOriginal,
      'id_act_fue_inf' => $fuenInf,
    );
    $idEnt = $obj->agregarDatosArchivosFI($datos);
    if ($idEnt > 0) {
      echo $idEnt;
    } else {
      echo 0;
    }
  }
}
