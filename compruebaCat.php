<?php
    session_start();
    if(isset($_GET['id'])){
        if($_GET['id']==0){
            $_SESSION['idCat']='0';
            header("Location: paginaPrincipal.php");
        }
        else{
        $_SESSION['idCat']=$_GET['id'];
        echo $_SESSION['idCat'];
        header("Location: paginaPrincipal.php?msg=2");
        }
    }
   
?>