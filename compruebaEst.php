<?php
    session_start();
    if(isset($_GET['id'])){
        if($_GET['id']=='T'){
            $_SESSION['est']='T';
            header("Location: paginaPrincipal.php");
        }
        else{
        $_SESSION['est']=$_GET['id'];
        header("Location: paginaPrincipal.php?msg=3");
        }
    }
   
?>