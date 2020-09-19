<?php 
	require_once "../../clases/Usuario.php";
	$obj   = new Usuario(); //creo mi objeto
$datos = $obj->mostrarDatos(); //creo mi nueva instancia

$tabla = '<table id="iddatatable" class="table-striped table-bordered
		dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
			<tr class="thead">
				<td style="max-width: 28px;">No.</td>
				<td>Nombre</td>
				<td>E-mail</td>
				<td>Usuario</td>
				<td style="max-width: 64px;">Opciones</td>
			</tr>
		</thead>
		<tfoot style="background-color:#ccc;color:white;font-weight:bold;height:40px;">
			<tr>
			    <td>No.</td>
			    <td>Nombre</td>
				<td>E-mail</td>
                <td>Opciones</td>
                <td>Usuario</td>
			</tr>
		</tfoot>
		<tbody class="body-tabla">';

$datosTabla = "";

foreach ($datos as $key => $value) {
	$datosTabla = $datosTabla . '<tr>
                <td class="text-center"></td>
                <td>'.$value['nombre']. '</td>
                <td>'.$value['email'].'</td>
                <td>'.$value['usuario'].'</td>
                <td class="text-center">

                    <!-- botones mandan por medio de onclick a mis funciones en mysite.js -->
                    <!-- Editar -->
                    <span class="btn btn-info btn-sm" data-toggle="modal" data-target="#editarRegistro" data-backdrop="static" id="editar" onclick="obtenerDatos('.$value['id_usuario'].')">
                        <span class="fas fa-edit"></span>
                    </span>

                    <!-- Eliminar -->
                    <span class="btn btn-danger btn-sm ml-2" id="eliminar" onclick="eliminarDatos('.$value['id_usuario'].')">
                        <span class="far fa-trash-alt"></span>
                    </span>
                </td>
            </tr>';
}
echo $tabla.$datosTabla.'</tbody></table>';

	
 ?>