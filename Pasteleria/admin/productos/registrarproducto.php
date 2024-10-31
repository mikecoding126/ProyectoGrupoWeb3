<?php
   /* session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }*/
    require '../../includes/config/database.php';
    $db=conectarDB();
    if ($_POST) {
        $i=$_FILES['ima']['name'];
        $n=$_POST['nom'];
        $d=$_POST['des'];
        $p=$_POST['pre'];
        $v=$_POST['pro'];
        $con_sql="INSERT INTO productos (imagen, nombre, descripcion, precio, proveedor_id, estado) VALUES ('$i', '$n', '$d', '$p', '$v', 'disponible')";
        $res=mysqli_query($db,$con_sql);
        if ($res) {
            
            $tmp=$_FILES['ima']['tmp_name'];
            
            $destination = 'imagenes/' . $i;
            if (@copy($tmp, $destination)) {
                ?>
                <script>
                    alert('Se registró');
                    location.href='listado.php';
                </script>
                <?php
            } else {
                echo "ERROR al copiar el archivo.";
            }
        } else {
            echo "ERROR al insertar en la base de datos.";
        }
    }
?>