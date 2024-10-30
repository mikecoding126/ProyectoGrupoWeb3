<?php
    /*session_start();
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
        $con_sql="UPDATE productos SET estado='nodisponible' WHERE codigo_producto='$cod'";
        $res=mysqli_query($db, $con_sql); 
        if ($res) {
            echo "
                <script>
                    alert('Producto agotado');
                    location.href='listado.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Producto disponible');
                </script>
            ";
        }
    ?>
</main>

<?php
    incluirTemplate('footer');
?>