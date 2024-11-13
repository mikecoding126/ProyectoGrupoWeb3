<?php 
    session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }
  require '../../includes/config/database.php';
  $db=conectarDB(); 
    if ($_POST) {
        $n=$_POST['nom'];
        $a=$_POST['ape'];
        $c=$_POST['cor'];
        $t=$_POST['tel'];
        $m=$_POST['men'];
       
        echo " nom".$n;
        echo " ape".$a;
        echo " cor".$cor;
        echo " tel".$t;
        echo " men".$m;
        $con_sql= "insert into contacto (nombre,apellido,correo,telefono,mensaje)values('$n','$a','$c','$t','$m')";
        $res= mysqli_query($db,$con_sql);
        if ($res) {
         
            ?> 
            <script> 
                alert ('se registro');
                location.href='../../index.php';
            </script>
            <?php
        }    
        else
        echo "ERROR";
    }
    ?>