<!doctype html>
<html lang="en">
<?php 
  include_once 'con_desc_db.php';
  $dbname="evention";
  
  try{  
      $mysqli = conectar($dbname);
      session_start();
      $idUser=$_SESSION['id'];
      
      $selectcategorias="Select id, nombre from categoria;";
      if(isset($_GET['msg'])){
        if($_GET['msg']==2){
        $idCat=$_SESSION['idCat'];
        $selectTareasById="Select id,descripcion,estado,fechaEntrega,idCategoria from tarea where idUsuario='".$idUser."' and idCategoria='".$idCat."' order by fechaEntrega;";
        }
        else
        $selectTareasById="Select id,descripcion,estado,fechaEntrega,idCategoria from tarea where idUsuario='".$idUser."' order by fechaEntrega;";
      }
      else{
        $selectTareasById="Select id,descripcion,estado,fechaEntrega,idCategoria from tarea where idUsuario='".$idUser."' order by fechaEntrega;";
      }     
      $tareas=$mysqli->query($selectTareasById);

      $categorias=$mysqli->query($selectcategorias);
?>
<head>
  <title>Pagina Principal</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="img/favicon.jpg">
</head>

<body>
  <div class="container rounded shadow p-0">
    <nav class="navbar shadow rounded-top sticky-top navbar-expand-lg navbar-light bg-success">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
        aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <form method="post" id="formCategoria" action="">
              <select class="custom-select" id="selectCategorias">
                <option value="" selected>Elija una Categoría</option>
                <option value="0">Todas</option>
                <?php foreach($categorias as $categoria){ ?>
                <option value="<?=$categoria['id']?>"><?=$categoria['nombre']?></option>
                <?php } ?>
              </select>
            </form>      
          </li>
          <li class="nav-item mt-2 text-light">
            <input class="ml-3" id="entregadas" value="E" checked name="realizacionTarea" type="radio"><label
              for="entregadas">Entregadas</label>
            <input class="ml-3" id="porHacer" value="ST" name="realizacionTarea" type="radio"><label for="porHacer">Por
              Hacer</label>
            <input class="ml-3" id="enProceso" value="P" name="realizacionTarea" type="radio"><label for="enProceso">En
              Proceso</label>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0 ">
          <a href="javascript:operacion('anadir')" class="btn btn-outline-light my-2 "
             type="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
            Añadir Tarea</a>
          <a href="deleteSession.php" class="btn btn-outline-light my-2 ml-3" type="button"><i class="fas fa-sign-out-alt"></i>&nbsp; Cerrar Sesión</a>
        </form>
      </div>
    </nav>
    <div class="row justify-content-center">
      <?php foreach($tareas as $tarea){
        $selectNombreCat="Select id,nombre from categoria where id='".$tarea['idCategoria']."';";
        $resulCat=$mysqli->query($selectNombreCat);
        $cat=$resulCat->fetch_assoc(); 
        ?>
        <div class="col-lg-5 col-md-12 my-3 d-flex mx-2">
          <div class="card shadow flex-fill" data-value="<?=$tarea['estado']?>">
            <div class="card-body">
              <div class="row justify-content-between text-light">
                <div class="col-auto">
                  <p class=" p-0 mt-1" id="categoria"><?=$cat['nombre']?></p>
                </div>
                <div class="col-auto">
                  <label id="fechaEntrega"><?=$tarea['fechaEntrega']?></label>
                </div>
              </div>
              <div class="row text-light">
                <div class="col">
                  <h4 id="descripcion" class="text-center"><?=$tarea['descripcion']?></h4>
                </div>
              </div>
              
                <div class="row justify-content-between">
                  <div class="col-auto">
                    <a href="javascript:operacion('modificar','<?=$tarea['id']?>','<?=$cat['nombre']?>','<?=$tarea['fechaEntrega']?>','<?=$tarea['descripcion']?>','<?=$tarea['estado']?>')" class="btn btn-info mb-1 mt-2" type="button"><i
                        class="fa fa-edit" aria-hidden="true"></i>&nbsp; Modificar Tarea</a>
                  </div>
                  <div class="col-auto">
                    <a href="javascript:deleteTarea('<?=$tarea['id']?>','<?=$idUser?>')" class="btn btn-light mb-1 mt-2" type="button"><i class="fa fa-trash"
                        aria-hidden="true"></i>&nbsp; Borrar Tarea</a>
                  </div>
                </div>
              
            </div>
          </div>
        </div>
      <?php }?>
    </div>
    <footer class="fixed-bottom bg-info">
    <div class="row  py-3 mx-0">
      <div class="col">
        <h4 id="futProy" class="text-center text-light">EVENTION &nbsp; <i class="fas fa-copyright aria-hidden=" true"></i>&nbsp;
          Jesus Diaz-Bernardo</h3>
      </div>
    </div>
    <div class="row text-light text-center">
          <div class="col  p-2">
            <h3 class="text-center text-light">
              <a href="" class="btn"><i class="fab fa-facebook"></i></a>
              <a href="" class="btn"><i class="fab fa-instagram"></i></a>
              <a href="" class="btn"><i class="fab fa-twitter"></i></a>
              <a href="" class="btn"><i class="fab fa-reddit"></i></a>
              <a href="" class="btn"><i class="fab fa-mastodon" a></i></a>
              <a href="" class="btn"><i class="fab fa-discord"></i></a>
              <a href="" class="btn"><i class="fab fa-github"></i></a>
            </h3>
          </div>
        </div>
        </footer>
  </div>
 <!--MODAL INSERTAR O MODIFICAR-->
  <div class="modal fade" id="modalInsertarModificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-white" id="title"></h5>
          <button type="button" class="close text-light ocultarModal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formInsertUpt" action="insertUptTarea.php" method="post">
          <input type="hidden"  name="idTarea" id="idTarea">
          <input type="hidden" name="idUser" id="idUser" value="<?=$idUser?>">
          <div class="row mt-2 d-flex align-items-center">
            <div class="col">
              <label for="modalCategoria">Categoria</label>
              <input type="text" id="modalCategoria" name="modalCategoria" class="form form-control form-control-sm"
                placeholder="Categoria" />
            </div>
            <div class="col">
              <label for="modalFechaEntrega">Fecha Entrega</label>
              <input type="date" name="modalFechaEntrega" class="form form-control form-control-sm" id="modalFechaEntrega">
            </div>
          </div>
          <div class="row mt-3">
            <div class="col">
              <div class="form-group">
                <label for="modalDescrip">Descripcion</label>
                <textarea class="form-control" id="modalDescrip" name="modalDesc" rows="3"></textarea>
              </div>
            </div>
          </div>
          
          <fieldset class="border p-2">
            <legend class="w-auto" style="font-size: 18px;">Estado Tarea</legend>
            <div class="row">
              <div class="col">
                <input class="ml-3" id="modalEntregadas" value="E" name="modalRealizacionTarea" type="radio" checked><label
                  for="entregadas">Entregadas</label>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <input class="ml-3" id="modalPorHacer" value="ST" name="modalRealizacionTarea" type="radio"><label
                  for="modalPorHacer">Por
                  Hacer</label>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <input class="ml-3" id="modalEnProceso" value="P" name="modalRealizacionTarea" type="radio"><label
                  for="modalEnProceso">En
                  Proceso</label>
              </div>
            </div>
          </fieldset>             
         
        </div>
        <div class="text-center d-flex justify-content-between modal-footer">
          <button type="button" class="btn btn-secondary ocultarModal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancelar</button>
          <button id="btnInsertUpt" type="button" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Guardar</button>
        </div>
        </form>  
      </div>
    </div>    
  </div>
  <?php
      desconectar($mysqli);
    }
    catch(exception $e){
            $e->getMessage();
        }
    ?>
  ?>
  <!--FIN MODAL INSERTAR MODIFICAR--> 
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js"
      integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a"
      crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script>
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
      $('#btnInsertUpt').on('click', function(){
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
      });
      function deleteTarea(idTarea, idUser) {
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
      // Función para verificar si el parámetro de consulta "mensaje" está presente
      function mostrarMensaje() {
            const mensaje = $.urlParam('msg');
            if (mensaje === '1') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Cambios Guardados',
                    showConfirmButton: false,
                    timer: 1000
                })
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
      $('.ocultarModal').click(function(){
        $("#modalInsertarModificar").modal("hide");
      })
      $('.card').filter('[data-value="E"]').addClass('bg-success');
      $('.card').filter('[data-value="P"]').addClass('bg-warning');
      $('.card').filter('[data-value="ST"]').addClass('bg-danger');
     
      $('#selectCategorias').on('change',function(){
        var optionSelected= $('#selectCategorias').val();
        $('#formCategoria').attr('action','compruebaCat.php?id='+optionSelected);
        $('#formCategoria').submit();
      })
  </script>
</body>

</html>