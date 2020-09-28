<?php 
require_once "../../clases/Proyecto.php";
$obj   = new Proyecto(); //creo mi objeto
$id = $_POST['id'];
$datos = $obj->mostrarDatosMaterias($id); //creo mi nueva instancia

$tabla = '<table id="iddatatableMateria" class="table-striped table-bordered
		dt-responsive nowrap" style="width:100%">
        <thead class="head-tabla">
			<tr class="thead">
				<td style="max-width: 28px;">No.</td>
				<td>Nombre</td>
                <td>Clave</td>
				<td style="max-width: 64px;">Eliminar</td>
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
                    <span class="btn btn-danger btn-sm ml-2" id="eliminar" onclick="eliminarDatosMateria('.$value['id_asignatura'].')">
                        <span class="far fa-trash-alt"></span>
                    </span>
                </td>
            </tr>';
}
echo $tabla.$datosTabla.'</tbody></table>';

	
 ?>