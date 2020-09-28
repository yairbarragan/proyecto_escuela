<?php
require_once "../../clases/Proyecto.php";
$obj = new Proyecto(); //creo mi objeto

$idProyecto         = $_POST['id_proyectoAr'];
$nombreImg          = $_FILES['archivo']['name'];
$nombreOriginal     = $_FILES['archivo']['name'];
$rutaAlmacenamiento = $_FILES['archivo']['tmp_name'];
$carpeta            = '../../archivos/';
$rutaFinal          = $carpeta . $nombreImg;
if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {
  $ext1        = explode(".", $_FILES['archivo']['name']);
  $extension   = end($ext1);
  $hora        = date('His');
  $fechaInsert = date("Y-m-d");
  rename($rutaFinal, $carpeta . $fechaInsert . "-" . $hora . "-" . $idProyecto . "." . $extension);
  $nombreImg = $fechaInsert . "-" . $hora . "-" . $idProyecto . "." . $extension;
  $rutaFinal = $carpeta . $fechaInsert . "-" . $hora . "-" . $idProyecto . "." . $extension;
  $datosImg  = array(
    'id_proyecto' => $idProyecto,
    'nombre'      => $nombreImg,
    'ruta'        => $rutaFinal,
    'tipo'        => "archivo",
    'extension'   => $extension,
    'original'    => $nombreOriginal,
  );
  if ($obj->agregarDatosArchivos($datosImg)) {
    echo 1;
  } else {
    echo 0;
  }
}