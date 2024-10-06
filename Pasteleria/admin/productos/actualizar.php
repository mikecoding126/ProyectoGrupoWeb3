<?php
    session_start();
    $auth = $_SESSION['login'];
    if (!$auth) {
        header("Location:/pasteleria");
    }
    require '../../includes/config/database.php';
    $db = conectarDB();
    require '../../includes/funciones.php';
    incluirTemplate('header');

    $cod = $_GET['cod'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $des = $_POST['des'];
        $pre = $_POST['pre'];

        $imagen = $_FILES['ima']['name'];
        $tmpImagen = $_FILES['ima']['tmp_name'];
        $carpetaImagenes = '../../imagenes/';
        $nuevaImagen = '';

        if ($imagen) {
            move_uploaded_file($tmpImagen, $carpetaImagenes . $imagen);
            $nuevaImagen = ", imagen='$imagen'";
        }
        $pro = $_POST['pro']; 

        $con_sql = "UPDATE productos SET nombre='$nom', descripcion='$des', precio='$pre', idProv='$pro' $nuevaImagen WHERE codProducto='$cod'";

        $resm = mysqli_query($db, $con_sql);

        if ($resm) {
            echo "
            <script>
                window.alert('Registro modificado con éxito');
                window.location='listado.php';
            </script>";
        } else {
            echo "
            <script>
                window.alert('Hubo un error al modificar el registro');
            </script>";
        }
    }

    $consulta = "SELECT * FROM productos WHERE codProducto='$cod'";
    $res = mysqli_query($db, $consulta);
    $fila = mysqli_fetch_array($res);
?>
    <main class="contenedor seccion">
        <h1>MODIFICAR PRODUCTO</h1>
        <a href="listado.php" class="btn btn-primary">Volver</a>
        <form action="actualizar.php?cod=<?php echo $fila['codProducto']; ?>" method="post" enctype="multipart/form-data">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td>Imagen</td>
                    <td>
                        <img src="imagenes/<?php echo $fila['imagen']; ?>" alt="Imagen Actual" width="100">
                        <input type="file" name="ima" id="ima" accept="image/jpeg, image/png, image/jpg">
                    </td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" class="form-control" name="nom" id="nom" value="<?php echo $fila['nombre']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Descripción</td>
                    <td><textarea class="form-control" name="des" id="des"><?php echo $fila['descripcion']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Precio</td>
                    <td><input type="number" class="form-control" name="pre" id="pre"
                            value="<?php echo $fila['precio']; ?>"></td>
                </tr>
                <tr>
                <td>Proveedor</td>
                <td>
                    <select name="pro" id="pro">
                        <?php
                        $queryProveedores = "SELECT * FROM proveedores";
                        $resultProveedores = mysqli_query($db, $queryProveedores);
                        while ($rowProveedor = mysqli_fetch_assoc($resultProveedores)) {
                            $selected = ($rowProveedor['idProv'] == $fila['idProv']) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $rowProveedor['idProv']; ?>" <?php echo $selected; ?>>
                                <?php echo $rowProveedor['nomProv'] . " " . $rowProveedor['telProv']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
                <tr>
                    <td colspan="2">
                        <div align="center"><input type="submit" name="Modificar" id="Modificar" value="Modificar"
                                class="btn btn-primary"></div>
                    </td>
                </tr>
            </table>
        </form>
<?php
    incluirTemplate('footer'); 
?>