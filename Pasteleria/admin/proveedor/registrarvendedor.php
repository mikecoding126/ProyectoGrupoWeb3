<?php
      session_start();
      $auth = $_SESSION['login'];
      if(!$auth){
          header("Location:/pasteleria");
      }

    require '../../includes/config/database.php';
    $db=conectarDB();

    if($_POST){
        $n = $_POST['mom'];
        $t = $_POST['tel'];
        $c = $_POST['corr'];
        $d = $_POST['dir'];
        $e = $_POST['estado']; // Solo agregamos esta línea para el estado

        $con_sql = "INSERT INTO proveedores (nombre,telefono,correo,direccion,estado) 
                    VALUES ('$n','$t','$c','$d','$e')"; // Modificamos solo la consulta
        $res = mysqli_query($db,$con_sql);
        
        if($res){
            echo "
                <script> 
                    alert ('Se añadio proveedor');
                    window.location.href='listado.php';
                </script>
            ";
        }else{
            echo "No se añadio";
        }
    }
?>