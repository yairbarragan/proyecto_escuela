$(document).ready(function(){

})

function mostrarDatos() {
    //carga con datatables
    $.ajax({
        type:"POST",
        url:"../procesos/proyecto/mostrarDatos.php",
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

function insertarDatos() {
    datos=$('#frmNuevo').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/proyecto/agregarDatos.php",
        success:function(r){
            //alert(r);
            if(r==1){
                $('#frmNuevo')[0].reset();
                mostrarDatos();
                swal("!Guardado con exito¡",":D","success");
            } else if (r=="AE") {
                swal("!El Asesor y Estudiante ya se encuentran registrados en un Proyecto¡",":0","warning");
            } else if (r=="E") {
                swal("!El estudiante ya se encuentra registrado en un Proyecto¡",":0","warning");
            } else if (r=="A") {
                swal("!El asesor ya se encuentra registrado en un Proyecto¡",":0","warning");
            } 
            else{
                swal("!No se pudo Guardar¡",":(","error");
            }
        }
    });
    return false;
}

function obtenerDatos(id) {
    $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"../procesos/proyecto/obtenerDatos.php",
        success:function(r){
            //alert(r);
            json=jQuery.parseJSON(r);
            $('#id_proyecto').val(json['id_proyecto']);
            $('#nombreU').val(json['nombre']);
            $('#tituloU').val(json['titulo']);
            $('#area_aplicacionU').val(json['area_aplicacion']);
            $('#id_asesorU').val(json['id_asesor']);
            $('#id_estudianteU').val(json['id_estudiante']);
        }
    });
    return false;
}

function actualizarDatos() {
    datos=$('#frmActualizar').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/proyecto/actualizarDatos.php",
        success:function(r){
            alert(r);
            if(r==1){
                mostrarDatos();
                swal("!Guardado con exito¡",":D","success");
            } else if (r==2) {
                swal("!La clave de carrera ya existe¡",":0","warning");
            } else{
                swal("!No se pudo Guardar¡",":(","error");
            }
        }
    });
    return false;
}


/*function mostrarDatosMaterias() {
    //carga con datatables
    $.ajax({
        type:"POST",
        url:"../procesos/proyecto/mostrarDatosMaterias.php",
        success: function(r){
            $('#tablaCargaMaterias').html(r);
            var t = $('#iddatatableMaterias').DataTable( {
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
mostrarDatosMaterias();*/ //cargaDatos