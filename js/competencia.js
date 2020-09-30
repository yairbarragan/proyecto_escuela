$(document).ready(function(){

})
/// competencia
function mostrarDatos() {
    //carga con datatables
    $.ajax({
        type:"POST",
        url:"../procesos/competencia/mostrarDatos.php",
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
        url:"../procesos/competencia/agregarDatos.php",
        success:function(r){
            //alert(r);
            if(r==1){
                $('#frmNuevo')[0].reset();
                mostrarDatos();
                swal("!Guardado con exito¡",":D","success");
            } else if (r==2) {
                swal("!La asignatura ya ha sido agregada a una competencia¡",":0","warning");
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
        url:"../procesos/competencia/obtenerDatos.php",
        success:function(r){
            //alert(r);
            json=jQuery.parseJSON(r);
            $('#id_competencia').val(json['id_competencia']);
            $('#nombreU').val(json['nombre']);
            $('#campo_desar_asigU').val(json['campo_desar_asig']);
            $('#campo_desar_proyintU').val(json['campo_desar_proyint']);
            $('#id_asignaturaU').val(json['id_asignatura']);
            $.ajax({
                type:"POST",
                data:"id=" + id,
                url:"../procesos/competencia/obtenerNombreasignatura.php",
                success:function(re){
                    //alert(re);
                    $('#id_asignaturaU').val(re);
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
        url:"../procesos/competencia/actualizarDatos.php",
        success:function(r){
            //alert(r);
            if(r==1){
                mostrarDatos();
                swal("!Guardado con exito¡",":D","success");
            } else if (r==2) {
                swal("!La asignatura ya ha sido agregada a una competencia¡",":0","warning");
            } else{
                swal("!No se pudo Guardar¡",":(","error");
            }
        }
    });
    return false;
}

function eliminarDatos(idCompetencia) {
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
            data:"idCompetencia=" + idCompetencia,
            url:"../procesos/competencia/eliminarDatos.php",
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



/// entregable
idC = $('#idComp').val();
function mostrarDatosEntregable(idC) {
    //carga con datatables
    $.ajax({
        type:"POST",
        data:"id=" + idC,
        url:"../procesos/competencia/mostrarDatosEntregable.php",
        success: function(r){
            $('#tablaCargaEntregable').html(r);
            var t = $('#iddatatableEntregable').DataTable( {
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

mostrarDatosEntregable(idC);

function obtenerDatosEntregable(id) {
    $.ajax({
        type:"POST",
        data:"id="+id,
        url:"../procesos/competencia/obtenerDatosEntregable.php",
        success:function(r){
            //alert(r);
            json=jQuery.parseJSON(r);
            $('#id_entregable').val(json['id_entregable']);
            $('#entregable').val(json['entregable']);
            $('#descripcion').val(json['descripcion']);
        }
    });
    return false;
}

function actualizarDatosEntregable() {
    datos=$('#frmActualizarEntregable').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/competencia/actualizarDatosEntregable.php",
        success:function(r){
            //alert(r);
            if(r==1){
                mostrarDatosEntregable(idC);
                swal("!Guardado con exito¡",":D","success");
            } else if (r==2) {
                swal("!La asignatura ya ha sido agregada a una competencia¡",":0","warning");
            } else{
                swal("!No se pudo Guardar¡",":(","error");
            }
        }
    });
    return false;
}


/// evidencia -- desempeno
function obtenerDatosEvidencia(id) {
    $.ajax({
        type:"POST",
        data:"id="+id,
        url:"../procesos/competencia/obtenerDatosEvidencia.php",
        success:function(r){
            //alert(r);
            json=jQuery.parseJSON(r);
            $('#id_entregableE').val(json['id_entregable']);
            $('#url').val(json['url']);
            $('#descripcionE').val(json['descripcion']);
            $.ajax({
                type:"POST",
                data:"id=" + id,
                url:"../procesos/competencia/obtenerDatosDesempeno.php",
                success:function(re){
                    json=jQuery.parseJSON(re);
                    $('#puntos').val(json['puntos']);
                    $('#descripcionD').val(json['descripcion']);
                }
            });
        }
    });
    return false;
}
function actualizarDatosEvidencia() {
    datos=$('#frmEvi').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/competencia/actualizarDatosEvidencia.php",
        success:function(r){
            //alert(r);
            if(r==1){
                //$('#frmEvi')[0].reset();
                //mostrarDatos();
                swal("!Guardado con exito¡",":D","success");
            } else if (r==2) {
                swal("!La asignatura ya ha sido agregada a una competencia¡",":0","warning");
            } else{
                swal("!No se pudo Guardar¡",":(","error");
            }
        }
    });
    return false;
}


/// actividad archivos
function obtenerIdEntregable(idEntregable){
    $('.id_entregableM').val(idEntregable);
    obtenerArchivoMA(idEntregable);
    obtenerArchivoFI(idEntregable);
    obtenerArchivoAE(idEntregable);
    obtenerArchivoAA(idEntregable);
}

    // material apoyo
function insertarArchivoMA(){
    if ($('#matApo').val() == "") {
        swal(":0",'Selecciona un archivo',"info");
        return false;
    }
    if ($('#matApo').val() !== "") {
        var archivoInput = document.getElementById('matApo');
        var archivoRuta = archivoInput.value;
        var extPermitidas = /(.pdf)$/i;
        if (!extPermitidas.exec(archivoRuta)) {
            swal(":0",'Formato archivo permitido .pdf',"info");
            archivoInput.value = '';
            return false;
        }
    }
    var formData = new FormData(document.getElementById("frmArchivoMA"));
    $.ajax({
        url:"../procesos/competencia/archivos/agregarArchivoMA.php",
        type: "POST",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(r) {
            if(r > 0){
                //$('#frmArchivoMA')[0].reset();
                id = r;
                obtenerArchivoMA(id);
                swal(":D","Agregadó con éxito :D","success");
            } else if (r == "E") {
                swal(":(","Ya existe un archivo agregado :(","error");
            } else{
                swal(":(","Falló al agregar :(","error");
            }
        }
    });
    return false;
}

function obtenerArchivoMA(id){
    $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"../procesos/competencia/archivos/obtenerArchivoMA.php",
        success:function(r){
            $("#mostrarArchivosMA").html(r);
        }
    });
}

function eliminarArchivoMA(idArchivo) {
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
            url:"../procesos/competencia/archivos/eliminarArchivoMA.php",
            success:function(r){
                if(r > 0){
                    obtenerArchivoMA(r);
                    swal("!Eliminado con exito¡",":D","info");
                } else{
                    swal("!Error no se pudo eliminar¡",":(","error");
                }
            }
        });
      }
    });
}

    // fuentes informacion
function insertarArchivoFI(){
    if ($('#fuenInf').val() == "") {
        swal(":0",'Selecciona un archivo',"info");
        return false;
    }
    if ($('#fuenInf').val() !== "") {
        var archivoInput = document.getElementById('fuenInf');
        var archivoRuta = archivoInput.value;
        var extPermitidas = /(.pdf)$/i;
        if (!extPermitidas.exec(archivoRuta)) {
            swal(":0",'Formato archivo permitido .pdf',"info");
            archivoInput.value = '';
            return false;
        }
    }
    var formData = new FormData(document.getElementById("frmArchivoFI"));
    $.ajax({
        url:"../procesos/competencia/archivos/agregarArchivoFI.php",
        type: "POST",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(r) {
            if(r > 0){
                //$('#frmArchivoMA')[0].reset();
                id = r;
                obtenerArchivoFI(id);
                swal(":D","Agregadó con éxito :D","success");
            } else if (r == "E") {
                swal(":(","Ya existe un archivo agregado :(","error");
            } else{
                swal(":(","Falló al agregar :(","error");
            }
        }
    });
    return false;
}

function obtenerArchivoFI(id){
    $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"../procesos/competencia/archivos/obtenerArchivoFI.php",
        success:function(r){
            $("#mostrarArchivosFI").html(r);
        }
    });
}

function eliminarArchivoFI(idArchivo) {
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
            url:"../procesos/competencia/archivos/eliminarArchivoFI.php",
            success:function(r){
                if(r > 0){
                    obtenerArchivoFI(r);
                    swal("!Eliminado con exito¡",":D","info");
                } else{
                    swal("!Error no se pudo eliminar¡",":(","error");
                }
            }
        });
      }
    });
}

// actividad AE
function insertarArchivoAE(){
    if ($('#actAE').val() == "") {
        swal(":0",'Selecciona un archivo',"info");
        return false;
    }
    if ($('#actAE').val() !== "") {
        var archivoInput = document.getElementById('actAE');
        var archivoRuta = archivoInput.value;
        var extPermitidas = /(.pdf)$/i;
        if (!extPermitidas.exec(archivoRuta)) {
            swal(":0",'Formato archivo permitido .pdf',"info");
            archivoInput.value = '';
            return false;
        }
    }
    var formData = new FormData(document.getElementById("frmArchivoAE"));
    $.ajax({
        url:"../procesos/competencia/archivos/agregarArchivoAE.php",
        type: "POST",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(r) {
            if(r > 0){
                //$('#frmArchivoMA')[0].reset();
                id = r;
                obtenerArchivoAE(id);
                swal(":D","Agregadó con éxito :D","success");
            } else if (r == "E") {
                swal(":(","Ya existe un archivo agregado :(","error");
            } else{
                swal(":(","Falló al agregar :(","error");
            }
        }
    });
    return false;
}

function obtenerArchivoAE(id){
    $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"../procesos/competencia/archivos/obtenerArchivoAE.php",
        success:function(r){
            $("#mostrarArchivosAE").html(r);
        }
    });
}

function eliminarArchivoAE(idArchivo) {
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
            url:"../procesos/competencia/archivos/eliminarArchivoAE.php",
            success:function(r){
                if(r > 0){
                    obtenerArchivoAE(r);
                    swal("!Eliminado con exito¡",":D","info");
                } else{
                    swal("!Error no se pudo eliminar¡",":(","error");
                }
            }
        });
      }
    });
}


// actividad AE
function insertarArchivoAA(){
    if ($('#actAA').val() == "") {
        swal(":0",'Selecciona un archivo',"info");
        return false;
    }
    if ($('#actAA').val() !== "") {
        var archivoInput = document.getElementById('actAA');
        var archivoRuta = archivoInput.value;
        var extPermitidas = /(.pdf)$/i;
        if (!extPermitidas.exec(archivoRuta)) {
            swal(":0",'Formato archivo permitido .pdf',"info");
            archivoInput.value = '';
            return false;
        }
    }
    var formData = new FormData(document.getElementById("frmArchivoAA"));
    $.ajax({
        url:"../procesos/competencia/archivos/agregarArchivoAA.php",
        type: "POST",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(r) {
            if(r > 0){
                //$('#frmArchivoMA')[0].reset();
                id = r;
                obtenerArchivoAA(id);
                swal(":D","Agregadó con éxito :D","success");
            } else if (r == "E") {
                swal(":(","Ya existe un archivo agregado :(","error");
            } else{
                swal(":(","Falló al agregar :(","error");
            }
        }
    });
    return false;
}

function obtenerArchivoAA(id){
    $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"../procesos/competencia/archivos/obtenerArchivoAA.php",
        success:function(r){
            $("#mostrarArchivosAA").html(r);
        }
    });
}

function eliminarArchivoAA(idArchivo) {
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
            url:"../procesos/competencia/archivos/eliminarArchivoAA.php",
            success:function(r){
                if(r > 0){
                    obtenerArchivoAA(r);
                    swal("!Eliminado con exito¡",":D","info");
                } else{
                    swal("!Error no se pudo eliminar¡",":(","error");
                }
            }
        });
      }
    });
}