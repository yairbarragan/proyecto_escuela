<?php 
require_once "../../clases/Proyecto.php";
$obj   = new Proyecto(); //creo mi objeto
$datos = $obj->mostrarDatosMaterias(); //creo mi nueva instancia

$tabla = '<table id="iddatatableMaterias" class="table-striped table-bordered
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

                    <!-- Eliminar -->
                    <span class="btn btn-danger btn-sm ml-2" id="eliminar" onclick="eliminarDatos('.$value['id_materia'].')">
                        <span class="far fa-trash-alt"></span>
                    </span>
                </td>
            </tr>';
}
echo $tabla.$datosTabla.'</tbody></table>';

	
 ?>