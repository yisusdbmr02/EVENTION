<?php
include_once 'con_desc_db.php';
$dbname="evention";
try{  
    $mysqli = conectar($dbname);
                $idTarea=$_GET['id'];
                $user=$_GET['user'];
                $deleteTarea = "delete from tarea where id='$idTarea' ";
                $mysqli->query($deleteTarea);
                header("Location: paginaPrincipal.php?user=$user&msg=1");
            
            desconectar($mysqli);
}
catch(exception $e){
        $e->getMessage();
    }
?>