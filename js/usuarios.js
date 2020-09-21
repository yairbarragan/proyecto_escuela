$(document).ready(function(){

	var fechaA = new Date();
    var yyyy = fechaA.getFullYear();
	$("#periodo_ingreso").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1900:' + yyyy,
        dateFormat: "yy-mm-dd"
    });

    $('#periodo_ingresoU').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1900:' + yyyy,
        dateFormat: "yy-mm-dd"
    });

	$('#asesor').hide();
	$('#estudiante').hide();
    $('.asesor-input').removeAttr('required');
    $('.estudiante-input').removeAttr('required');

	$($('#id_rol_usuario')).change(function(){
		if ($('#id_rol_usuario').val() == 2) {
            $(".asesor-input").prop('required',true);
			$('.estudiante-input').removeAttr('required')
            $('#asesor').show();
			$('#estudiante').hide();
            $('.reset').val("");
		}else if ($('#id_rol_usuario').val() == 3) {
            $(".estudiante-input").prop('required',true);
            $('.asesor-input').removeAttr('required');
			$('#asesor').hide();
			$('#estudiante').show();
            $('.reset').val("");
		} else {
            $('.asesor-input').removeAttr('required');
            $('.estudiante-input').removeAttr('required');
			$('#asesor').hide();
			$('#estudiante').hide();
            $('.reset').val("");
		}
	});

    $($('#id_rol_usuarioU')).change(function(){
        if ($('#id_rol_usuarioU').val() == 2) {
            $(".asesor-input").prop('required',true);
            $('.estudiante-input').removeAttr('required')
            $('#asesorU').show();
            $('#estudianteU').hide();
            $('.reset').val("");
        }else if ($('#id_rol_usuarioU').val() == 3) {
            $(".estudiante-input").prop('required',true);
            $('.asesor-input').removeAttr('required');
            $('#asesorU').hide();
            $('#estudianteU').show();
            $('.reset').val("");
        } else {
            $('.asesor-input').removeAttr('required');
            $('.estudiante-input').removeAttr('required');
            $('#asesorU').hide();
            $('#estudianteU').hide();
            $('.reset').val("");
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

function insertarDatos() {
    datos=$('#frmNuevo').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/usuario/agregarDatos.php",
        success:function(r){
            //alert(r);
            if(r==1){
                $('#frmNuevo')[0].reset();
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

function obtenerDatos(id) {
    $.ajax({
        type:"POST",
        data:"id=" + id,
        url:"../procesos/usuario/obtenerDatos.php",
        success:function(r){
            //alert(r);
            json=jQuery.parseJSON(r);
            $('#id_usuario').val(json['id_usuario']);
            $('#nombreU').val(json['nombre']);
            $('#emailU').val(json['email']);
            $('#usuarioU').val(json['usuario']);
            //$('#passwordU').val(json['password']);
            rol = json['id_rol_usuario'];
            $('#id_rol_usuarioU').val(rol);
            if (rol == 2) {
                $('#asesorU').show();
                $('#estudianteU').hide();
            } else {
                $('#asesorU').hide();
                $('#estudianteU').show();
            }
            /*asesor*/
            $('#no_empleadoU').val(json['no_empleado']);
            $('#grado_estudiosU').val(json['grado_estudios']);
            $('#id_carreraU').val(json['id_carrera']);
            /*estudiante*/
            $('#no_controlU').val(json['no_control']);
            $('#generoU').val(json['genero']);
            $('#periodo_ingresoU').val(json['periodo_ingreso']);
        }
    });

    return false;
}

function actualizarDatos() {
    datos=$('#frmActualizar').serialize();
    $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/usuario/actualizarDatos.php",
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
            url:"../procesos/usuario/eliminarDatos.php",
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