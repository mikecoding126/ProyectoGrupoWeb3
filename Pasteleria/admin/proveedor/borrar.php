<?php
   /* session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }
    */
    require '../../includes/config/database.php';
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