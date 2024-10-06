<?php
    function conectarDB(){
        $db=mysqli_connect('localhost','root','','pasteleria');
        if($db){
            echo "Se conecto";
        }
        else{
            echo "No se conecto"; 
        }
        return $db;
    }
?>
