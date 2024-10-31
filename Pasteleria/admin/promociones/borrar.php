<?php
   /* session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }*/
    require '../../includes/config/database.php';
    $db=conectarDB();
    
    require '../../includes/funciones.php';
    incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Borrar</h1>
    <?php 
        $cod=$_GET['cod'];
        $con_sql="UPDATE promociones SET estado='Agotado' WHERE codPromocion='$cod'";
        $res=mysqli_query($db, $con_sql); 
        if ($res) {
            echo "
                <script>
                    alert('Promoción agotada');
                    location.href='listado.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Promoción disponible');
                </script>
            ";
        }
    ?>
</main>

<?php
    incluirTemplate('footer');
?>