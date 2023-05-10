<?php 
     include_once 'con_desc_db.php';
     $dbname="evention";
     try{  
         $mysqli = conectar($dbname);
             if(isset($_POST['idTarea'])&&isset($_POST['idUser'])&&isset($_POST['modalCategoria'])&&isset($_POST['modalFechaEntrega'])&&isset($_POST['modalDesc'])&&isset($_POST['modalRealizacionTarea'])){
                $idTarea=$_POST['idTarea'];
                $categoria=$_POST['modalCategoria'];
                $selectCategoria="select id,nombre from categoria where nombre='$categoria'";
                $resulCat=$mysqli->query($selectCategoria);
                if(mysqli_num_rows($resulCat) == 0) {
                    $insertCat="Insert into categoria (nombre) values ('$categoria')";
                    $mysqli->query($insertCat);
                }
                $resulCat=$mysqli->query($selectCategoria);
                $user=$_POST['idUser'];
                $estado=$_POST['modalRealizacionTarea'];
                $fechaEntrega=$_POST['modalFechaEntrega'];
                $descrip=$_POST['modalDesc'];
                $cat=$resulCat->fetch_assoc();
                if($idTarea == '0'){
                    $insertTarea = "Insert into tarea (descripcion,estado,fechaEntrega,idUsuario,IdCategoria)values('$descrip','$estado','$fechaEntrega','$user',".$cat['id'].");";
                    $mysqli->query($insertTarea);
                    header("Location: paginaPrincipal.php?user=$user&msg=1");
                }
                else{
                    $updateTarea = "Update tarea set descripcion='$descrip',estado='$estado',fechaEntrega='$fechaEntrega',idUsuario='$user',idCategoria='".$cat['id']."' where id='$idTarea';";
                    echo $updateTarea;
                    $mysqli->query($updateTarea);
                    header("Location: paginaPrincipal.php?user=$user&msg=1");
                }
             }
             desconectar($mysqli);
     }
 
     catch(exception $e){
             $e->getMessage();
         }

?>
