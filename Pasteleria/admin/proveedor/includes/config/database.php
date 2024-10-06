<?php
    function conectarDB(){
        $db = mysqli_connect("localhost:3307", "root", "" ,"pasteleria");
        if (!$db) {
            echo "No se conecto";
        }
        return $db;
    }
?>