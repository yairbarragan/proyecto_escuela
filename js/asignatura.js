$(document).ready(function(){

	

})

function mostrarDatos() {
    //carga con datatables
    $.ajax({
        type:"POST",
        url:"../procesos/asignatura/mostrarDatos.php",
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

function mostrarDatosEstudiante() {
    //carga con datatables
    $.ajax({
        type:"POST",
        url:"../procesos/asignatura/mostrarDatosEstudiante.php",
        success: function(r){
            $('#tablaCargaEstudiante').html(r);
            var t = $('#iddatatableEstudiante').DataTable( {
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
mostrarDatosEstudiante(); //cargaDatos