<?php
/*
    session_start();
    $auth = $_SESSION['login'];
    if (!$auth) {
        header("Location:/pasteleria");
    }*/
    require '../../includes/config/database.php';
    $db = conectarDB();
    require '../../includes/funciones.php';
  /*  incluirTemplate('header');*/

    $cod = $_GET['cod'];
    if(isset($_POST['Modificar'])){
        $n = $_POST['nom'];
        $t = $_POST['tel'];
        $c = $_POST['corr'];
        $d = $_POST['dir'];

        $con_sql = "UPDATE proveedores SET nomProv='$n', telProv=$t, correoProv = '$c', dirProv='$d' WHERE idProv='$cod'";
        $resm = mysqli_query($db,$con_sql);
        if($resm){
            echo "
            <script>
                alert('registro modificado con exito');
                window.location.href='listado.php';
            </script>
            ";
        }
    }
?>
<main class = "contenedor seccion">
    <h1>Modifica vendedor</h1>
    <a href="listado.php" class="btn btn-primary">Volver</a>

    <?php
        $consulta = "select * from proveedores where idProv=$cod";
        $res = mysqli_query($db,$consulta);
        while($fila=mysqli_fetch_array($res)){
    ?>
    <form action="actualizar.php?cod=<?php echo $fila ['idProv'];?>" method="post">
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <td>Nombre</td>
                <td><input type="text" class="form-control" name="nom" id="nom" value="<?php echo $fila['nomProv'];?>"></td>
            </tr>
            <tr>
                <td>Telefono</td>
                <td><input type="number" class="form-control" name="tel" id="tel" value="<?php echo $fila['telProv'];?>"></td>
            </tr>

            <tr>
                <td>Correo</td>
                <td><input type="e-mail" class="form-control" name="corr" id="corr" value="<?php echo $fila['correoProv'];?>"></td>
            </tr>

            <tr>
                <td>Direccion</td>
                <td><input type="text" class="form-control" name="dir" id="dir" value="<?php echo $fila['dirProv'];?>"></td>
            </tr>
            <tr>
            <td colspan="3">
                <div align="center">
                    <input type="submit" name="Modificar" id="Modificar" value="Modificar" class="btn btn-primary">
            </td>
            </tr>
        <?php
            }  
        ?>  
        </table>
    </form>
    
</main>
<?php
  //  incluirTemplate('footer');
    ?>