<!doctype html>
<html lang="en">
<head>
  <title>EVENTION</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="img/favicon.jpg">
</head>
<body>
  <section class="vh-100">
    <div class="container-fluid h-100 bg-success">
      <header class="sticky-top">
        <div class="row bg-info text-light  text-center">
          <div class="col p-2">
            <h1 id="hedProj">EVENTION</h1>
          </div>
        </div>
        <div class="row bg-info text-light text-center">
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
      </header>
      <div class="row d-flex justify-content-center  align-items-center ">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="img/imgPaginaLogin.png" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-4">
          <div class="card shadow">
            <div class="card-header">
              <h2 class="text-muted text-center">Inicio de Sesión</h2>
            </div>
            <form action="comprobarUser.php" method="post">
              <div class="card-body">
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <div class="row">
                    <div class="col">
                      <input type="text" id="loginUser" name="loginUser" value="<?php if(isset($_GET['usuario'])) echo $_GET['usuario']?>" class="form-control form-control-lg"
                        placeholder="Introduce un nombre de usuario" />
                      <label class="form-label" for="form3Example3">Nombre Usuario</label>
                    </div>
                  </div>
                </div>
                <!-- Password input -->
                <div class="form-outline mb-3">
                  <input type="password" id="loginPass" name="loginPass" class="form-control form-control-lg"
                    placeholder="Introduce una contraseña" />
                  <label class="form-label" for="form3Example4">Contraseña</label>
                </div>
                <div class="row">
                  <div class="col">
                  <span><?php if(isset($_GET['msg'])) echo $_GET['msg']?></span>  
                  </div>
                </div>
                <div class="text-center d-flex justify-content-between mt-4 mb-1 text-lg-start ">
                  <button type="submit" class="btn btn-dark btn-lg"><i class="fas fa-sign-in-alt"></i>&nbsp;
                    Inicio Sesión</button>
                  <a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalRegister"><i
                      class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;
                    Registrate</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<!--MODAL REGISTRAR-->
    <div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title text-white" id="exampleModalLabel">Registro</h5>
            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="insertUser.php" method="post">
            <div class="modal-body">
              <div class="row mt-2 d-flex align-items-center">
                <div class="col">
                  <input type="text" id="modalUser" name="regUser" class="form form-control form-control-sm"
                    placeholder="Nombre de Usuario" required/>
                </div>
                <div class="col">
                  <input type="password" id="modalContraseña" name="regPass" class="form form-control form-control-sm"
                    placeholder="Contraseña" required/>
                </div>
              </div>
              <div class="row mt-2 d-flex align-items-center">
                <div class="col-6">
                  <input type="text" id="modalNombre" required  name="regName" class="form form-control form-control-sm" placeholder="Nombre" />
                </div>
              </div>
              <div class="row mt-2 d-flex align-items-center">
                <div class="col">
                  <input type="text" id="modalape1" required name="regApe1" class="form form-control form-control-sm"
                    placeholder="Primer Apellido" />
                </div>
                <div class="col">
                  <input type="text" id="modalape2" required name="regApe2" class="form form-control form-control-sm"
                    placeholder="Segundo Apellido" />
                </div>
              </div>
              <div class="row mt-3">
                <div class="col">
                  <label for="modalFechaNacimiento">Fecha Nacimiento</label>
                  <input type="date" max-width="200px" required name="fechNac" class="form form-control form-control-sm"
                    id="modalFechaNacimiento">
                </div>
                <div class="col">
                  <label for="modalTel">Telefono</label>
                  <input type="tel" max-width="200px" name="tel" required placeholder="617287674" class="form form-control form-control-sm"
                    id="ModalTel">
                </div>
              </div>
              <fieldset class="border p-2">
                <legend class="w-auto" style="font-size: 18px;">Género</legend>
                <div class="row">
                  <div class="col">
                    <input class="ml-3" id="modalMujerGenero" checked name="modalGenero" value="M" type="radio"><label
                      for="modalGenero" >Mujer</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <input class="ml-3" id="modalHombreGenero" name="modalGenero" value="H" type="radio"><label
                      for="modalGenero">Hombre</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <input class="ml-3" id="modalOtroGenero" name="modalGenero" value="O" type="radio"><label
                      for="modalGenero">Otro</label>
                  </div>
                </div>
              </fieldset>
              <fieldset class="border p-2">
                <legend class="w-auto" style="font-size: 18px;">Estado Actual</legend>
                <div class="row">
                  <div class="col">
                    <input class="ml-3" id="modalEstud" name="estado" value="E" checked type="radio"><label
                      for="estado" >Estudiante</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <input class="ml-3" id="modalTrabaj" name="estado" value="T" type="radio"><label
                      for="estado">Trabajador/a</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <input class="ml-3" id="modalOtro" name="estado" value="O" type="radio"><label
                      for="estado">Otro</label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="text-center d-flex justify-content-between modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"
                  aria-hidden="true"></i>&nbsp; Cancelar</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check"
                  aria-hidden="true"></i>&nbsp;Aceptar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
<!--FIN MODAL REGISTRAR-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"></script>
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
      $('#modalRegister').on('shown.bs.modal', function () {
        $('#modalNombre').focus();
      });
      $('#loginPass').focus();
    </script>
</body>

</html>