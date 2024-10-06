<?php
    session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }
    require '../../includes/config/database.php';
    $db=conectarDB();
    if ($_POST) {
        $i=$_FILES['ima']['name'];
        $n=$_POST['nom'];
        $d=$_POST['des'];
        $p=$_POST['pre'];
        $v=$_POST['pro'];
        $con_sql="INSERT INTO productos (imagen, nombre, descripcion, precio, idProv, estado) VALUES ('$i', '$n', '$d', '$p', '$v', 'Disponible')";
        $res=mysqli_query($db,$con_sql);
        if ($res) {
            // Corregimos el error en la función copy()
            $tmp=$_FILES['ima']['tmp_name'];
            // Copiamos el archivo a la carpeta deseada con el nombre correcto
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