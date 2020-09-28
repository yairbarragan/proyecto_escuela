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

function insertarDatos() {
    datos=$('#frmNuevo').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/asignatura/agregarDatos.php",
        success:function(r){
            //alert(r);
            if(r==1){
                $('#frmNuevo')[0].reset();
                mostrarDatos();
                swal("!Guardado con exito¡",":D","success");
            } else if (r==2) {
                swal("!La clave de asignatura ya existe¡",":0","warning");
            } else{
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
        url:"../procesos/asignatura/obtenerDatos.php",
        success:function(r){
            //alert(r);
            json=jQuery.parseJSON(r);
            $('#id_asignatura').val(json['id_asignatura']);
            $('#nombreU').val(json['nombre']);
            $('#claveU').val(json['clave']);
            $('#creditosU').val(json['creditos']);

            $.ajax({
                type:"POST",
                data:"id=" + id,
                url:"../procesos/asignatura/obtenerNombreCarrera.php",
                success:function(re){
                    //alert(re);
                    $('#id_carreraU').val(re);
                }
            });
        }
    });

    return false;
}

function actualizarDatos() {
    datos=$('#frmActualizar').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/asignatura/actualizarDatos.php",
        success:function(r){
            //alert(r);
            if(r==1){
                mostrarDatos();
                swal("!Guardado con exito¡",":D","success");
            } else if (r==2) {
                swal("!La clave ya existe¡",":0","warning");
            } else{
                swal("!No se pudo Guardar¡",":(","error");
            }
        }
    });
    return false;
}

function eliminarDatos(id) {
    swal({
      title: "¿Seguro de eliminar?",
      text: "!Una vez eliminado no podra recuperarse¡",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
            type:"POST",
            data:"id=" + id,
            url:"../procesos/asignatura/eliminarDatos.php",
            success:function(r){
                //alert(r);
                if(r==1){
                    mostrarDatos();
                    swal("!Eliminado con exito¡",":D","info");
                } else{
                    swal("!Error¡",":(","error");
                }
            }
        });
      }
    });
}

// area
function insertarDatosArea() {
    datos=$('#frmNuevaArea').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/asignatura/agregarDatosArea.php",
        success:function(r){
            //alert(r);
            if(r==1){
                mostrarDatos();
                swal("!Guardado con exito¡",":D","success");
            } else if (r==2) {
                swal("!La clave de asignatura ya existe¡",":0","warning");
            } else{
                swal("!No se pudo Guardar¡",":(","error");
            }
        }
    });
    return false;
}

function obtenerDatosArea(id) {
    $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"../procesos/asignatura/obtenerDatosArea.php",
        success:function(r){
            //alert(r);
            json=jQuery.parseJSON(r);
            $('#id_asignaturaA').val(json['id_asignatura']);
            $('#nombre_asig').val(json['nombre']);
            $('#aportacion').val(json['aportacion']);
            $('#nodo_problema').val(json['nodo_problema']);
        }
    });

    return false;
}


//estudiante
id = $('#idAsig').val();
function mostrarDatosEstudiante(id) {
    //carga con datatables
    $.ajax({
        type:"POST",
        data:"id=" + id,
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
mostrarDatosEstudiante(id); //cargaDatos

function obtenerDatosEstudiante(id) {
    $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"../procesos/asignatura/obtenerDatosEstudiante.php",
        success:function(r){
            //alert(r);
            json=jQuery.parseJSON(r);
            $('#id_estudianteU').val(json['id_estudiante']);
            $('#calif').val(json['calif']);
        }
    });

    return false;
}

function actualizarDatosEstudiante() {
    datos=$('#frmActualizar').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/asignatura/actualizarDatosEstudiante.php",
        success:function(r){
            //alert(r);
            if(r==1){
                mostrarDatosEstudiante(id);
                swal("!Guardado con exito¡",":D","success");
            } else if (r==2) {
                swal("!La clave ya existe¡",":0","warning");
            } else{
                swal("!No se pudo Guardar¡",":(","error");
            }
        }
    });
    return false;
}

function insertarEstudiante() {
    datos=$('#frmNuevaEstudiante').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/asignatura/agregarEstudiante.php",
        success:function(r){
            //alert(r);
            if(r==1){
                $('#frmNuevaEstudiante')[0].reset();
                mostrarDatosEstudiante(id);
                swal("!Guardado con exito¡",":D","success");
            } else if (r==2) {
                swal("!El estudiante ya se encuentra registrado¡",":0","warning");
            } else{
                swal("!No se pudo Guardar¡",":(","error");
            }
        }
    });
    return false;
}

function eliminarEstudiante(id) {
    idAsig = $('#idAsig').val();
    swal({
      title: "¿Seguro de eliminar?",
      text: "!Una vez eliminado no podra recuperarse¡",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
            type:"POST",
            data:'&id=' + id + '&idAsig=' + idAsig,
            url:"../procesos/asignatura/eliminarEstudiante.php",
            success:function(r){
                //alert(r);
                if(r==1){
                    mostrarDatosEstudiante(id);
                    swal("!Eliminado con exito¡",":D","info");
                } else{
                    swal("!Error¡",":(","error");
                }
            }
        });
      }
    });
}