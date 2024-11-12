<?php
   /* session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }*/

    require '../../includes/config/database.php';
    $db = conectarDB();
    
    if ($_POST) {
        $c = mysqli_real_escape_string($db, $_POST['cod']);
        $n = mysqli_real_escape_string($db, $_POST['nom']);
        $d = mysqli_real_escape_string($db, $_POST['des']);
        $ca = mysqli_real_escape_string($db, $_POST['categoria_id']);
        $p = mysqli_real_escape_string($db, $_POST['pre']);
        $i = $_FILES['ima']['name'];
        $v = mysqli_real_escape_string($db, $_POST['pro']);
        $s = mysqli_real_escape_string($db, $_POST['st']);
    
        // Primero verificamos si el código de producto ya existe
        $check_codigo = "SELECT codigo_producto FROM productos WHERE codigo_producto = '$c'";
        $result_check = mysqli_query($db, $check_codigo);
    
        if (mysqli_num_rows($result_check) > 0) {
            // El código ya existe
            ?>
            <script>
                alert('Error: El código de producto ya existe. Por favor, use otro código.');
                window.history.back();
            </script>
            <?php
            exit;
        }
    
        // Si el código no existe, procedemos con la inserción
        $con_sql = "INSERT INTO productos (
            codigo_producto, 
            nombre, 
            descripcion,
            categoria_id, 
            precio,
            imagen,
            estado,
            stock,
            unidad_medida,
            proveedor_id
        ) VALUES (
            '$c', 
            '$n', 
            '$d',
            '$ca', 
            '$p',
            '$i',
            'disponible',
            '$s',
            'Unidad', 
            '$v'
        )";
    
        $res = mysqli_query($db, $con_sql);
        if ($res) {
            $tmp = $_FILES['ima']['tmp_name'];
            $destination = 'imagenes/' . $i;
            
            if (@copy($tmp, $destination)) {
                ?>
                <script>
                    alert('Se registró correctamente');
                    location.href='listado.php';
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert('Error al copiar la imagen');
                    window.history.back();
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert('Error al insertar en la base de datos: <?php echo mysqli_error($db); ?>');
                window.history.back();
            </script>
            <?php
        }
    }
    ?>