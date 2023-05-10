<?php
    include_once 'con_desc_db.php';
    $dbname="evention";
    try{  
        $mysqli = conectar($dbname);
            
            if(isset($_POST['tel'])&&isset($_POST['estado'])&&isset($_POST['regUser'])&&isset($_POST['regPass'])&&isset($_POST['regName'])&&isset($_POST['regApe1'])&&isset($_POST['regApe2'])&&isset($_POST['fechNac'])&&isset($_POST['modalGenero'])){
                $user=$_POST['regUser'];
                $tel=$_POST['tel'];
                $estado=$_POST['estado'];
                $user=$_POST['regUser'];
                $name=$_POST['regName'];
                $ape1=$_POST['regApe1'];
                $fechNac=$_POST['fechNac'];
                $genero=$_POST['modalGenero'];
                $ape2=$_POST['regApe2'];
                $password=$_POST['regPass'];
                $password=password_hash("$password", PASSWORD_DEFAULT);
                echo $user."".$password;
                $insertuser = "Insert into usuarios (nombre,apellido1,apellido2,telefono,login,password,genero,estado,fechaNacimiento)values('$name','$ape1','$ape2','$tel','$user','$password','$genero','$estado','$fechNac');";
                echo '<br>'.$insertuser;
                $mysqli->query($insertuser);
                header("Location: index.php?usuario=$user");
            }
            desconectar($mysqli);
    }

    catch(exception $e){
            $e->getMessage();
        }

?>