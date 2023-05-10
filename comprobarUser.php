<?php
include_once 'con_desc_db.php';
$dbname="evention";

try{  
    $mysqli = conectar($dbname);
            if(isset($_POST['loginUser'])&&isset($_POST['loginPass'])){
                $user=$_POST['loginUser'];
                $password=$_POST['loginPass'];
                $selectuserbypassword="Select id,login,password from usuarios where login='$user'";
                $resulpass=$mysqli->query($selectuserbypassword);
                $int=$resulpass->fetch_assoc();             
                if (password_verify($password, $int['password'])) {
                    session_start();
                    $_SESSION['usuario']=$int['login'];
                    $_SESSION['id']=$int['id'];
                    header('Location: paginaPrincipal.php');
                } else {
                    $msg='El usuario o contraseña no es válido.';
                    header('Location: index.php?msg='.$msg.'');
                }
            }
            desconectar($mysqli);
}
catch(exception $e){
        $e->getMessage();
    }
?>