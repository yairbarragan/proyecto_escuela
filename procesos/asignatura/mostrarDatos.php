<?php 
	require_once "../../clases/Asignatura.php";
	$obj   = new Asignatura(); //creo mi objeto
$datos = $obj->mostrarDatos(); //creo mi nueva instancia

$tabla = '<table id="iddatatable" class="table-striped table-bordered
		dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
			<tr class="thead">
				<td style="max-width: 28px;">No.</td>
				<td>Nombre</td>
				<td>Creditos</td>
				<td>Carrera</td>
				<td>Competencia</td>
				<td>Área Aplicación</td>
				<td style="max-width: 64px;">Opciones</td>
			</tr>
		</thead>
		<tfoot style="background-color:#ccc;color:white;font-weight:bold;height:40px;">
			<tr>
			    <td>No.</td>
			    <td>Nombre</td>
                <td>Creditos</td>
				<td>Carrera</td>
                <td>Competencia</td>
                <td>Área Aplicación</td>
                <td>Opciones</td>
			</tr>
		</tfoot>
		<tbody class="body-tabla">';

$datosTabla = "";

foreach ($datos as $key => $value) {
	$datosTabla = $datosTabla . '<tr>
                <td class="text-center"></td>
                <td>'.$value['nombre']. '</td>
                <td>'.$value['periodo_vigencia'].'</td>
                <td>
                	<span class="btn btn-info btn-sm" data-toggle="modal" data-target="#editarRegistro" data-backdrop="static" id="editar" onclick="obtenerDatos('.$value['id_carrera'].')">
                        <span class="fas fa-edit"></span>
                    </span>
                </td>
                <td class="text-center">

                    <!-- botones mandan por medio de onclick a mis funciones en mysite.js -->
                    <!-- Editar -->
                    <span class="btn btn-info btn-sm" data-toggle="modal" data-target="#editarRegistro" data-backdrop="static" id="editar" onclick="obtenerDatos('.$value['id_carrera'].')">
                        <span class="fas fa-edit"></span>
                    </span>

                    <!-- Eliminar -->
                    <span class="btn btn-danger btn-sm ml-2" id="eliminar" onclick="eliminarDatos('.$value['id_carrera'].')">
                        <span class="far fa-trash-alt"></span>
                    </span>
                </td>
            </tr>';
}
echo $tabla.$datosTabla.'</tbody></table>';

	
 ?>