<?php

    function conectar($bdname){
                return new mysqli("localhost","root","","".$bdname."", 3306);
            }
    function desconectar($mysql){
        mysqli_close($mysql);
    }
?>