<?php 
require_once "../../clases/Competencia.php";
$obj   = new Competencia(); //creo mi objeto

$id_competencia = $_POST['id'];    
$datos = $obj->mostrarDatosEntregable($id_competencia); //creo mi nueva instancia

$tabla = '<table id="iddatatableEntregable" class="table-striped table-bordered
		dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
			<tr class="thead">
				<td style="max-width: 28px;">No.</td>
				<td>Competencia</td>
                <td>Entregable</td>
				<td>Descripción</td>
                <td>Actividad EA</td>
                <td>Evidencia</td>
				<td style="max-width: 64px;">Opciones</td>
			</tr>
		</thead>
		<tbody class="body-tabla">';

$datosTabla = "";

foreach ($datos as $key => $value) {
	$datosTabla = $datosTabla . '<tr>
                <td class="text-center"></td>
                <td>'.$obj->nombreCompetencia($value['id_competencia']).'</td>
                <td>'.$value['entregable']. '</td>
                <td>'.$value['descripcion'].'</td>
                <td class="text-center">
                    <span class="btn btn-info btn-sm" data-toggle="modal" data-target="#agregarActividadEA" data-backdrop="static" id="editar" onclick="obtenerIdEntregable('.$value['id_entregable'].')">
                        <span class="fas fa-plus"></span>
                    </span>
                </td>
                <td class="text-center">
                    <span class="btn btn-info btn-sm" data-toggle="modal" data-target="#actualizarEvidencia" data-backdrop="static" id="editar" onclick="obtenerDatosEvidencia('.$value['id_entregable'].')">
                        <span class="fas fa-edit"></span>
                    </span>
                </td>
                <td class="text-center">

                    <!-- botones mandan por medio de onclick a mis funciones en mysite.js -->
                    <!-- Editar -->
                    <span class="btn btn-info btn-sm" data-toggle="modal" data-target="#editarEntregable" data-backdrop="static" id="editar" onclick="obtenerDatosEntregable('.$value['id_entregable'].')">
                        <span class="fas fa-edit"></span>
                    </span>
                </td>
            </tr>';
}
echo $tabla.$datosTabla.'</tbody></table>';

	
 ?>