<?php
   /* session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }
    */
<<<<<<< HEAD
    require '../../includes/config/database.php';
=======
    require "includes/config/database.php";
>>>>>>> d710bc7ebf1e9c236021b315703fdc5fed1dbd8d
    $db = conectarDB();
?>
<main class = "contenedor seccion">
    <h1>Borrar</h1>
    <?php
        $id=$_GET['cod'];
        $con = "DELETE FROM proveedores WHERE idProv=$id";
        $res = mysqli_query($db,$con);
        if($res){
            echo "
            <script> 
            alert ('Se elimino');
            window.location.href='listado.php';
            </script>
            ";
        }
        else{
            echo "No se eliminó";
        }
    ?>
</main>

<?php
  //  incluirTemplate("footer");
?>