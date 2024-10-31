<?php
    function conectarDB(){
        $db=mysqli_connect('localhost','root','','pasteleriac');
        if($db){
            echo "Se conecto";
        }
        else{
            echo "No se conecto"; 
        }
        return $db;
    }
?>
