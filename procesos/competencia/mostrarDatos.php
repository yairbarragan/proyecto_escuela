<?php 
	require_once "../../clases/Competencia.php";
	$obj   = new Competencia(); //creo mi objeto
$datos = $obj->mostrarDatos(); //creo mi nueva instancia

$tabla = '<table id="iddatatable" class="table-striped table-bordered
		dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
			<tr class="thead">
				<td style="max-width: 28px;">No.</td>
				<td>Nombre</td>
				<td>Desarrollo Asignatura</td>
                <td>Desarrollo Proyecto Integrador</td>
                <td>Entregable</td>
				<td style="max-width: 64px;">Opciones</td>
			</tr>
		</thead>
		<tbody class="body-tabla">';

$datosTabla = "";

foreach ($datos as $key => $value) {
	$datosTabla = $datosTabla . '<tr>
                <td class="text-center"></td>
                <td>'.$value['nombre']. '</td>
                <td>'.$value['campo_desar_asig'].'</td>
                <td>'.$value['campo_desar_proyint'].'</td>
                <td class="text-center">
                <a href="competenciaEntregable.php" class="btn btn-info btn-sm fas fa-plus"></a>
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