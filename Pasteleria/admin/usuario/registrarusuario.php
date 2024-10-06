<?php   
require '../../includes/config/database.php';
      $db=conectarDB();

   
    if ($_POST) {
        
        $e=$_POST['em'];
        $p=$_POST['pas'];
        $pashash=password_hash($p,PASSWORD_DEFAULT);
        var_dump($pashash);

        $con_sql="INSERT INTO usuarios(email,pasword) VALUES ('$e','$pashash')";
        $res=mysqli_query($db,$con_sql);
        if ($res) {
            echo "
            <script> 
            alert ('se registro');
            location.href='crear.php';
        </script>
             ";
        }    
    }
    
    
?>