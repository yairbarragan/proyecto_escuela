<?php 
	require_once "../../clases/Carrera.php";
	$obj   = new Carrera(); //creo mi objeto
$datos = $obj->mostrarDatos(); //creo mi nueva instancia

$tabla = '<table id="iddatatable" class="table-striped table-bordered
		dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
			<tr class="thead">
				<td style="max-width: 28px;">No.</td>
				<td>Nombre</td>
				<td>Clave</td>
				<td style="max-width: 64px;">Opciones</td>
			</tr>
		</thead>
		<tbody class="body-tabla">';

$datosTabla = "";

foreach ($datos as $key => $value) {
	$datosTabla = $datosTabla . '<tr>
                <td class="text-center"></td>
                <td>'.$value['nombre']. '</td>
                <td>'.$value['clave'].'</td>
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