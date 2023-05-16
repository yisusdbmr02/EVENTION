$('#modalRegister').on('shown.bs.modal', function () {
    $('#modalUser').focus();
  });
$('#loginPass').focus();
$('.ocultarModal').click(function(){
    $("#modalInsertarModificar").modal("hide");
})

function operacion(op,id,cat, fechEntrega, desc, estado ){
    if(op==="anadir"){
      $("#modalInsertarModificar").modal("show");
      $('#modalInsertarModificar').on('shown.bs.modal', function () {
        $('#modalCategoria').focus();
        $('#title').text("Añadir");
        $('#idTarea').val(0);
      });
    }else if(op==="modificar"){
      $("#modalInsertarModificar").modal("show");
      $('#modalInsertarModificar').on('shown.bs.modal', function () {
        $('#modalCategoria').focus();
        $('#title').text("Modificar");
        $('#idTarea').val(id);
        $('#modalCategoria').val(cat);
        $('#modalFechaEntrega').val(fechEntrega);
        $('#modalDescrip').val(desc);
        if(estado=="E")
          $("#modalEntregadas").prop("checked",true);
        else if(estado=="P")
          $("#modalEnProceso").prop("checked",true);
        else
        $("#modalPorHacer").prop("checked",true);
      });
    }
}

function deleteTarea(idTarea, idUser) {
    swalDelete(idTarea,idUser);
}

$('#btnInsertUpt').on('click', function(){
    swalInsUpt();
});

  // Función para verificar si el parámetro de consulta "mensaje" está presente
function mostrarMensaje() {
    const mensaje = $.urlParam('msg');
    if (mensaje === '1') {
       swalSuccess();
    }
}

    // Agrega la función $.urlParam a jQuery para obtener el valor de un parámetro de consulta
$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (!results) {
        return null;
    }
    return decodeURIComponent(results[1]) || 0;
}

    // Ejecuta la función cuando la página se carga
$(document).ready(mostrarMensaje);

$('.card').filter('[data-value="E"]').addClass('bg-success');
$('.card').filter('[data-value="P"]').addClass('bg-orange');
$('.card').filter('[data-value="ST"]').addClass('bg-danger');

$('#selectCategorias').on('change',function(){
var optionSelected= $('#selectCategorias').val();
$('#formCategoria').attr('action','compruebaCat.php?id='+optionSelected);
$('#formCategoria').submit();
})
$("[name='realizacionTarea']").on('change',function(){
var val= ''
if ($('#todas').prop('checked')) 
    val=$('#todas').val();
else if ($('#entregadas').prop('checked')) 
    val=$('#entregadas').val();
else if ($('#porHacer').prop('checked')) 
    val=$('#porHacer').val();
else
val=$('#enProceso').val();

$('#formEstado').attr('action','compruebaEst.php?id='+val);
$('#formEstado').submit();
})