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
            //alert(r);
            if(r==1){
                mostrarDatos();
                swal("!Guardado con exito¡",":D","success");
            } else if (r=="A") {
                swal("!El asesor ya esta registrado en un proyecto¡",":0","warning");
            } else if (r=="E") {
                swal("!El estudiante ya esta registrado en un proyecto¡",":0","warning");
            } else if (r=="EA") {
                swal("!Estudiante y asesor ya están registrado en un proyecto¡",":0","warning");
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
            url:"../procesos/proyecto/eliminarDatos.php",
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

function mostrarDatosMaterias(id) {
    //carga con datatables
    $('#id_proyectoM').val(id);
    $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"../procesos/proyecto/mostrarDatosMaterias.php",
        success: function(r){
            $('#tablaCargaMateria').html(r);
            var t = $('#iddatatableMateria').DataTable( {
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

function insertarDatosMateria() {
    id_proyecto = $('#id_proyectoM').val();
    datos=$('#frmNuevaMateria').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/proyecto/agregarDatosMateria.php",
        success:function(r){
            //alert(r);
            if(r==1){
                $('#frmNuevaMateria')[0].reset();
                mostrarDatosMaterias(id_proyecto);
                swal("!Guardado con exito¡",":D","success");
            } else if (r=="A") {
                swal("!La materia ya ha sido registrada¡",":0","warning");
            } else{
                swal("!No se pudo Guardar¡",":(","error");
            }
        }
    });
    return false;
}

function eliminarDatosMateria(id) {
    id_proyecto = $('#id_proyectoM').val();
    swal({
      title: "¿Seguro de eliminar?",
      text: "!Una vez eliminado no podra recuperarse¡",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var parametros = {
                "id" : id,
                "idP" : id_proyecto
        };
        $.ajax({
            type:"POST",
            data:parametros, 
            url:"../procesos/proyecto/eliminarDatosMateria.php",
            success:function(r){
                //alert(r);
                if(r==1){
                    mostrarDatosMaterias(id_proyecto);
                    swal("!Eliminado con exito¡",":D","info");
                } else{
                    swal("!Error¡",":(","error");
                }
            }
        });
      }
    });
}

function idProyectoArchivo(id) {
    $('#id_proyectoAr').val(id);
    obtenerArchivo(id);
}

function insertarArchivo() {

    if ($('#archivo').val() == "") {
        swal(":0",'Selecciona un archivo',"info");
        return false;
    }
    if ($('#archivo').val() !== "") {
        var archivoInput = document.getElementById('archivo');
        var archivoRuta = archivoInput.value;
        var extPermitidas = /(.pdf)$/i;
        if (!extPermitidas.exec(archivoRuta)) {
            swal(":0",'Formato archivo permitido .pdf',"info");
            archivoInput.value = '';
            return false;
        }
    }
    var formData = new FormData(document.getElementById("frmArchivo"));
    $.ajax({
        url:"../procesos/proyecto/agregarArchivo.php",
        type: "POST",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(r) {
            //alert(r);
            if(r==1){
                //$('#frmArchivo')[0].reset();
                obtenerArchivo($('#id_proyectoAr').val());
                swal(":D","Agregadó con éxito :D","success");
            }else{
                swal(":(","Falló al agregar :(","error");
            }
        }
    });
    return false;
}

function obtenerArchivo(idProyecto){
    $.ajax({
        type:"POST",
        data:"idProyecto=" + idProyecto,
        url:"../procesos/proyecto/obtenerArchivo.php",
        success:function(r){
            $("#mostrarArchivos").html(r);
        }
    });
}

function eliminarArchivo(idArchivo) {
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
            data:"idArchivo=" + idArchivo,
            url:"../procesos/proyecto/eliminarArchivo.php",
            success:function(r){
                //alert(r);
                if(r==1){
                    obtenerArchivo($('#id_proyectoAr').val());
                    swal("!Eliminado con exito¡",":D","info");
                } else{
                    swal("!Error no se pudo eliminar¡",":(","error");
                }
            }
        });
      }
    });
}