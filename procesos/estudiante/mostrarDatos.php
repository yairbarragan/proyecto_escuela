<?php
require_once "../../clases/Estudiante.php";
$obj            = new Estudiante(); //creo mi objeto
$idUsuario      = $_POST['idUsuario'];
$datos          = $obj->mostrarDatos($idUsuario); //creo mi nueva instancia

// DATOS USUARIO
echo "<p><b>DATOS</b></p>";
$tabla = '<table class="table-striped table-bordered
        dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
            <tr class="thead">
                <td>Nombre</td>
                <td>Usuario</td>
            </tr>
        </thead>
        <tbody class="body-tabla">';

$datosTabla = "";

foreach ($datos as $key => $value) {
    $idEstudiante = $obj->obtenerIdEstudiante($value['id_usuario']);
    $datosTabla = $datosTabla . '<tr>
                <td>' . $value['nombre'] . '</td>
                <td>' . $value['usuario'] . '</td>
            </tr>
            </tbody></table>';
}
echo $tablaUsuario = $tabla . $datosTabla;


// DATOS MATERIA
$idEstudiante   = $obj->obtenerIdEstudiante($idUsuario);
$datos          = $obj->obtenerNombreAsignatura($idEstudiante); //creo mi nueva instancia

echo "<div style='margin-top:50px;'></div>";
echo "<p><b>MATERIAS</b></p>";
$tabla = '<table class="table-striped table-bordered
        dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
            <tr class="thead">
                <td>Nombre</td>
                <td>Calificación</td>
            </tr>
        </thead>
        <tbody class="body-tabla">';

$datosTabla = "";

foreach ($datos as $key => $value) {
    $datosTabla = $datosTabla . '<tr>
                <td>' . $value['nombre'] . '</td>
                <td>' . $value['calif'] . '</td>
            </tr>';
}
echo $tabla.$datosTabla.'</tbody></table>';





























// DATOS PROYECTO
$idEstudiante = $obj->obtenerIdEstudiante($idUsuario);
$datos        = $obj->mostrarDatosProyecto($idEstudiante);
//print_r($datos);
echo "<div style='margin-top:50px;'></div>";

echo "<p><b>PROYECTO</b></p>";
$tabla = '<table class="table-striped table-bordered
        dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
            <tr class="thead">
                <td>Titulo</td>
                <td>Nombre</td>
                <td>Área Aplicación</td>
                <td>Asesor</td>
                <td>Archivo</td>
            </tr>
        </thead>
        <tbody class="body-tabla">';

$datosTabla = "";

foreach ($datos as $key => $value) {
    $datosTabla = $datosTabla . '<tr>
                <td>' . $value['titulo'] . '</td>
                <td>' . $value['nombre'] . '</td>
                <td>' . $value['area_aplicacion'] . '</td>
                <td>' . $value['nom'] . '</td>
                <td class="text-center p-2">' . $obj->obtenerArchivo($value['id_proyecto']) . '</td>
            </tr>
            </tbody></table>';
}
$tablaUsuario = $tabla . $datosTabla;
print_r($tablaUsuario);



?>