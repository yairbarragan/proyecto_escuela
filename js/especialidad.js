$(document).ready(function(){

	var fechaA = new Date();
    var yyyy = fechaA.getFullYear();
    $(".calendario").datepicker({
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        changeMonth: true,
        changeYear: true,
        yearRange: '1900:' + yyyy,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });

    $("#periodo_vigencia").keydown(function(e){
        e.preventDefault();
    });
    $("#periodo_vigenciaU").keydown(function(e){
        e.preventDefault();
    });
    $("#periodo_vigencia_dos").keydown(function(e){
        e.preventDefault();
    });
    $("#periodo_vigencia_dosU").keydown(function(e){
        e.preventDefault();
    });
})

function mostrarDatos() {
    //carga con datatables
    $.ajax({
        type:"POST",
        url:"../procesos/especialidad/mostrarDatos.php",
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
        url:"../procesos/especialidad/agregarDatos.php",
        success:function(r){
            //alert(r);
            if(r==1){
                $('#frmNuevo')[0].reset();
                mostrarDatos();
                swal("!Guardado con exito¡",":D","success");
            } else if (r==2) {
                swal("!El especialidad ya existe¡",":0","warning");
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
        url:"../procesos/especialidad/obtenerDatos.php",
        success:function(r){
            //alert(r);
            json=jQuery.parseJSON(r);
            $('#id_especialidad').val(json['id_especialidad']);
            $('#nombreU').val(json['nombre']);
            $('#periodo_vigenciaU').val(json['periodo_vigencia']);
            $('#periodo_vigencia_dosU').val(json['periodo_vigencia_dos']);
            

            $.ajax({
                type:"POST",
                data:"id=" + id,
                url:"../procesos/especialidad/obtenerNombreCarrera.php",
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
        url:"../procesos/especialidad/actualizarDatos.php",
        success:function(r){
            //alert(r);
            if(r==1){
                mostrarDatos();
                swal("!Guardado con exito¡",":D","success");
            } else if (r==2) {
                swal("!El usuario ya existe¡",":0","warning");
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
            url:"../procesos/especialidad/eliminarDatos.php",
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