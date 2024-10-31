<?php
<<<<<<< HEAD
/*
    session_start();
=======
    /*session_start();
>>>>>>> d710bc7ebf1e9c236021b315703fdc5fed1dbd8d
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }*/
    require '../../includes/config/database.php';
    $db=conectarDB();

    if($_POST){
        $n = $_POST['nom'];
        $t = $_POST['tel'];
        $c = $_POST['corr'];
        $d = $_POST['dir'];
        echo "$n $t $c $d";
        $con_sql = "INSERT INTO proveedores (nomProv,telProv,correoProv,dirProv) VALUES ('$n',$t,'$c','$d')";
        $res = mysqli_query($db,$con_sql);
        if($res){
            echo "
                <script> 
                    alert ('Se añadio proveedor');
                    window.location.href='listado.php';
                </script>
            ";
        }else
            echo "No se añadio";
    }
?>