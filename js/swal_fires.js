function swalDelete(idTarea, idUser){
    Swal.fire({
        title: '¿Estas seguro?',
        text: "Los cambios serán irreversibles",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Si, Eliminalos!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'deleteTarea.php?id='+idTarea+'&user='+idUser;

        }
    })
}
function swalInsUpt(){
    Swal.fire({
        text: "¿Quieres guardar los cambios?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Si, Guardalos!'
    }).then((result) => {
      $("#formInsertUpt").submit();
    })
}
function swalSuccess(){
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Cambios Guardados',
        showConfirmButton: false,
        timer: 1000
    })
}
function swalDeleteSession(){
    Swal.fire({
        title: '¿Seguro que quieres cerrar sesión?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Si, Cierra Sesión!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'deleteSession.php';
        }
    })
}