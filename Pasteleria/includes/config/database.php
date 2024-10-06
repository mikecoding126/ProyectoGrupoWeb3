<?php
    function conectarDB(){
        $db=mysqli_connect('localhost','root','','pasteleria');
        if(!$db){
            echo "No se conecto";
            exit;
        }
        return $db;
    }

?>