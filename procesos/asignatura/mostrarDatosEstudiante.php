<?php 
require_once "../../clases/Asignatura.php";
$obj   = new Asignatura(); //creo mi objeto
$id = $_POST['id'];
$datos = $obj->mostrarDatosEstudiante($id); //creo mi nueva instancia

$tabla = '<table id="iddatatableEstudiante" class="table-striped table-bordered
		dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
			<tr class="thead">
				<td style="max-width: 28px;">No.</td>
				<td>Nombre</td>
                <td>No Control</td>
                <td>Calificación</td>
				<td style="max-width: 64px;">Opciones</td>
			</tr>
		</thead>
		<tbody class="body-tabla">';

$datosTabla = "";

foreach ($datos as $key => $value) {
	$datosTabla = $datosTabla . '<tr>
                <td class="text-center"></td>
                <td>'.$value['nombre']. '</td>
                <td>'.$value['no_control'].'</td>
                <td>'.$value['calif'].'</td>
               
                <td class="text-center">

                    <!-- botones mandan por medio de onclick a mis funciones en mysite.js -->
                    <!-- Editar -->
                    <span class="btn btn-info btn-sm" data-toggle="modal" data-target="#editarRegistroEstudiante" data-backdrop="static" id="editar" onclick="obtenerDatosEstudiante('.$value['id_estudiante'].','.$value['id_asignatura'].')">
                        <span class="fas fa-edit"></span>  
                    </span>

                    <!-- Eliminar -->
                    <span class="btn btn-danger btn-sm ml-2" id="eliminar" onclick="eliminarEstudiante('.$value['id_estudiante'].')">
                        <span class="far fa-trash-alt"></span>
                    </span>
                </td>
            </tr>';
}
echo $tabla.$datosTabla.'</tbody></table>';

	
 ?>