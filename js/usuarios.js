$(document).ready(function(){

	var fechaA = new Date();
    var yyyy = fechaA.getFullYear();
	$("#periodo_ingreso").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1900:' + yyyy,
        dateFormat: "yy-mm-dd"
    });

    $('#periodo_ingresou').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1900:' + yyyy,
        dateFormat: "yy-mm-dd"
    });

	$('#asesor').hide();
	$('#estudiante').hide();

	$($('#id_rol_usuario')).change(function(){
		if ($('#id_rol_usuario').val() == 2) {
			$('#asesor').show();
			$('#estudiante').hide();
		}else if ($('#id_rol_usuario').val() == 3) {
			$('#asesor').hide();
			$('#estudiante').show();
		} else {
			$('#asesor').hide();
			$('#estudiante').hide();
		}
	});
})

function mostrarDatos() {
    //carga con datatables
    $.ajax({
        type:"POST",
        url:"../procesos/usuario/mostrarDatos.php",
        success: function(r){
            $('#tablaCarga').html(r);
            var t = $('#iddatatable').DataTable( {
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } ],
                "order": [[ 1, 'desc' ]]
            } );

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        }
    });
}
mostrarDatos(); //cargaDatos