<?php
    /*session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }*/
    require '../../includes/config/database.php';
// registrar.php - Procesa el registro de nueva promoción

$db = conectarDB();

if ($_POST) {
    $n = $_POST['nom'];
    $d = $_POST['des'];
    $p = $_POST['pre'];
    $i = $_FILES['ima']['name'];
    $producto_id = $_POST['producto_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $porcentaje_descuento = $_POST['porcentaje_descuento'];
    $monto_descuento = $_POST['monto_descuento'];
    
    $con_sql = "INSERT INTO promociones (nombre, descripcion, precio, imagen, producto_id, estado, fecha_inicio, fecha_fin, porcentaje_descuento, monto_descuento) 
                VALUES ('$n', '$d', '$p', '$i', '$producto_id', 'activa', '$fecha_inicio', '$fecha_fin', '$porcentaje_descuento', '$monto_descuento')";
    
    $res = mysqli_query($db, $con_sql);
    if ($res) {
        $tmp = $_FILES['ima']['tmp_name'];
        $destination = 'imagenes/' . $i;
        if (@copy($tmp, $destination)) {
            ?>
            <script>
                alert('Promoción registrada con éxito');
                location.href='listado.php';
            </script>
            <?php
        } else {
            echo "ERROR al copiar el archivo de imagen.";
        }
    } else {
        echo "ERROR al insertar en la base de datos.";
    }
}

