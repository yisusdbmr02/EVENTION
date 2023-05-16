<!doctype html>
<html lang="en">
<?php 
  include_once 'con_desc_db.php';
  $dbname="evention";
  
  try{  
      $mysqli = conectar($dbname);
      session_start();
      $idUser=$_SESSION['id'];
      $idCat=$_SESSION['idCat'];
      $est=$_SESSION['est'];
      $selectcategorias="Select id, nombre from categoria;";
      if(isset($_GET['msg'])){
        if($_GET['msg']==2){
        $idCat=$_SESSION['idCat'];
        if($est=='T')
          $selectTareasById="Select id,descripcion,estado,fechaEntrega,idCategoria from tarea where idUsuario='".$idUser."' and idCategoria='".$idCat."' order by fechaEntrega;";
        else
          $selectTareasById="Select id,descripcion,estado,fechaEntrega,idCategoria from tarea where idUsuario='".$idUser."' and estado='".$est."' and idCategoria='".$idCat."' order by fechaEntrega;";
        }elseif($_GET['msg']==3){
          $est=$_SESSION['est'];
          if($idCat=='0')
            $selectTareasById="Select id,descripcion,estado,fechaEntrega,idCategoria from tarea where idUsuario='".$idUser."' and estado='".$est."' order by fechaEntrega;";
          else{
            $selectTareasById="Select id,descripcion,estado,fechaEntrega,idCategoria from tarea where idUsuario='".$idUser."' and estado='".$est."' and idCategoria='".$idCat."' order by fechaEntrega;";
          }
        }else{
          if($est=='T'){
            if($idCat=='0')
              $selectTareasById="Select id,descripcion,estado,fechaEntrega,idCategoria from tarea where idUsuario='".$idUser."' order by fechaEntrega;";
            else
              $selectTareasById="Select id,descripcion,estado,fechaEntrega,idCategoria from tarea where idUsuario='".$idUser."' and idCategoria='".$idCat."' order by fechaEntrega;";
           }elseif($idCat=='0'){
            if($est=='T')
            $selectTareasById="Select id,descripcion,estado,fechaEntrega,idCategoria from tarea where idUsuario='".$idUser."' order by fechaEntrega;";
            else
            $selectTareasById="Select id,descripcion,estado,fechaEntrega,idCategoria from tarea where idUsuario='".$idUser."' and estado='".$est."' order by fechaEntrega;";
          }else
          $selectTareasById="Select id,descripcion,estado,fechaEntrega,idCategoria from tarea where idUsuario='".$idUser."' order by fechaEntrega;";
        }
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

<body class="">
  <div class="container rounded shadow p-0">
    <nav class="navbar shadow rounded-top sticky-top navbar-expand-lg navbar-light bg-info">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
        aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <form method="post" id="formCategoria" action="">
              <select class="custom-select" id="selectCategorias">
                <option value="0" <?php if($idCat == "0") echo "selected"; ?>>Todas las categorías</option>
                <?php foreach($categorias as $categoria){ ?>
                <option value="<?=$categoria['id']?>" <?php if($idCat == $categoria['id']) echo "selected"; ?> ><?=$categoria['nombre']?></option>
                <?php } ?>
              </select>
            </form>      
          </li>
          <li class="nav-item mt-2 text-light">
            <form id="formEstado" method="post" action="">
              <input class="ml-3" id="todas" value="T" <?php if($est == "T") echo "checked"; ?> name="realizacionTarea" type="radio"><label
                for="todas">&nbsp;Todas</label>
              <input class="ml-3" id="entregadas" value="E" <?php if($est == "E") echo "checked"; ?> name="realizacionTarea" type="radio"><label
                for="entregadas">&nbsp;Entregadas</label>
              <input class="ml-3" id="porHacer" value="ST" <?php if($est == "ST") echo "checked"; ?> name="realizacionTarea" type="radio"><label for="porHacer">&nbsp;Por
                Hacer</label>
              <input class="ml-3" id="enProceso" value="P" <?php if($est== "P") echo "checked"; ?> name="realizacionTarea" type="radio"><label for="enProceso">&nbsp;En
                Proceso</label>
            </form>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0 ">
          <a href="javascript:operacion('anadir')" class="btn btn-outline-light my-2 "
             type="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
            Añadir Tarea</a>
          <a href="javascript:cerrarSession()" class="btn btn-outline-light my-2 ml-3" type="button"><i class="fas fa-sign-out-alt"></i>&nbsp; Cerrar Sesión</a>
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
          <div class="card  flex-fill" data-value="<?=$tarea['estado']?>">
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
    <footer class="sticky-bottom">
    <div class="row  py-3 mx-0">
      <div class="col">
        <h4 id="footProj" class="text-right text-dark">EVENTION &nbsp; <i class="fas fa-copyright aria-hidden=" true"></i>&nbsp;
          Jesus Diaz-Bernardo</h4>
      </div>
    </div>
    <div class="row  text-center">
          <div class="col  p-2">
            <h3 class="text-right text-light">
              <a href="https://www.facebook.com/profile.php?id=100091753552672" target="_blank" class="btn"><i class="fab fa-facebook"></i></a>
              <a href="https://www.instagram.com/yisus_db02/" target="_blank" class="btn"><i class="fab fa-instagram"></i></a>
              <a href="https://twitter.com/jesusredrojo" target="_blank" class="btn"><i class="fab fa-twitter"></i></a>
              <a href="https://www.linkedin.com/in/jesus-d%C3%ADaz-bernardo-4b3390244/" target="_blank" class="btn"><i class="fab fa-linkedin"></i></a>
              <a href="https://mastodon.social/@yisus_dbmr02" target="_blank" class="btn"><i class="fab fa-mastodon"></i></a>
              <a href="https://github.com/yisusdbmr02" target="_blank" class="btn"><i class="fab fa-github"></i></a>
            </h3>
          </div>
        </div>
        </footer>
  </div>
 <!--MODAL INSERTAR O MODIFICAR-->
  <div class="modal fade" id="modalInsertarModificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
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
                  for="modalEntregadas">Entregadas</label>
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
          <button type="button" class="btn btn-outline-dark ocultarModal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancelar</button>
          <button id="btnInsertUpt" type="button" class="btn btn-info"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Guardar</button>
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
  <!--FIN MODAL INSERTAR MODIFICAR--> 

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="js/myjs.js"></script>
  <script src="js/swal_fires.js"></script>
</body>
</html>