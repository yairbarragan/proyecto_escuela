<?php
require_once "../../clases/Asesor.php";
$obj       = new Asesor(); //creo mi objeto
$idUsuario = $_POST['idUsuario'];
$datos     = $obj->mostrarDatos($idUsuario); //creo mi nueva instancia

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
    $idEstudiante = $obj->obtenerIdAsesor($value['id_usuario']);
    $datosTabla   = $datosTabla . '<tr>
                <td>' . $value['nombre'] . '</td>
                <td>' . $value['usuario'] . '</td>
            </tr>
            </tbody></table>';
}
echo $tablaUsuario = $tabla . $datosTabla;

// DATOS CARRERA
$idAsesor = $obj->obtenerIdAsesor($idUsuario);
$datos    = $obj->obtenerNombreCarrera($idAsesor); //creo mi nueva instancia

echo "<div style='margin-top:50px;'></div>";
echo "<p><b>CARRERA</b></p>";
$tabla = '<table class="table-striped table-bordered
        dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
            <tr class="thead">
                <td>Nombre</td>
                <td>Clave</td>
            </tr>
        </thead>
        <tbody class="body-tabla">';

$datosTabla = "";

foreach ($datos as $key => $value) {
    $datosTabla = $datosTabla . '<tr>
                <td>' . $value['nombre'] . '</td>
                <td>' . $value['clave'] . '</td>
            </tr>';
}
echo $tabla . $datosTabla . '</tbody></table>';

// DATOS PROYECTO
$idAsesor = $obj->obtenerIdAsesor($idUsuario);
$datos    = $obj->mostrarDatosProyecto($idAsesor);
//print_r($datos);
echo "<div style='margin-top:50px;'></div>";

echo "<p><b>PROYECTO</b></p>";
$tabla = '<table class="table-striped table-bordered
        dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
            <tr class="thead">
                <td>Asesor</td>
                <td>Titulo</td>
                <td>Nombre</td>
                <td>Área Aplicación</td>
                <td>Estudiante</td>
                <td>Archivo</td>
            </tr>
        </thead>
        <tbody class="body-tabla">';

$datosTabla = "";

foreach ($datos as $key => $value) {
    $datosTabla = $datosTabla . '<tr>
                <td>' . $value['nom'] . '</td>
                <td>' . $value['titulo'] . '</td>
                <td>' . $value['nombre'] . '</td>
                <td>' . $value['area_aplicacion'] . '</td>
                <td>' . $obj->obtenerDatosEstudiante($value['id_proyecto']) . '</td>
                <td class="text-center p-2">' . $obj->obtenerArchivo($value['id_proyecto']) . '</td>
            </tr>
            </tbody></table>';
}
$tablaUsuario = $tabla . $datosTabla;
print_r($tablaUsuario);







// DATOS MATERIAS PROYECTO
$idAsesor   = $obj->obtenerIdAsesor($idUsuario);
$idProyecto = $obj->obtenerIdProyecto($idAsesor);
$datos      = $obj->mostrarMateriasProyecto($idProyecto);
//print_r($datos);

echo "<div style='margin-top:50px;'></div>";

echo "<p><b>PROYECTO MATERIAS</b></p>";
$tabla = '<table class="table-striped table-bordered
        dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
            <tr class="thead">
                <td>Materia</td>
                <td>Clave</td>
            </tr>
        </thead>
        <tbody class="body-tabla">';

$datosTabla = "";

foreach ($datos as $key => $value) {
    $datosTabla = $datosTabla . '<tr>
                                    <td>' . $value['nombre'] . '</td>
                                    <td>' . $value['clave'] . '</td>
                                </tr>
                               ';
}
echo $tabla . $datosTabla . '</tbody></table>';

?>