$(document).ready(function(){

})
idUsuario = $('#idUsuario').val();

function mostrarDatos($idUsuario) {
    //carga con datatables
    $.ajax({
        type:"POST",
        data:"idUsuario=" + idUsuario,
        url:"../procesos/asesor/mostrarDatos.php",
        success: function(r){
            $('#tablaCarga').html(r);
        }
    });
}
mostrarDatos(); //cargaDatos
