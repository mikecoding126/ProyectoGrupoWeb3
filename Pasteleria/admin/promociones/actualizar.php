<?php
/*session_start();
$auth = $_SESSION['login'];
if (!$auth) {
    header("Location:/pasteleria");
}*/
require '../../includes/config/database.php';
$db = conectarDB();

require '../../includes/funciones.php';
incluirTemplate('header');

$id = $_GET['id']; // Cambiado de cod a id

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nom'];
    $descripcion = $_POST['des'];
    $precio = $_POST['pre'];
    $producto_id = $_POST['producto_id'];
    $estado = $_POST['estado'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $porcentaje_descuento = $_POST['porcentaje_descuento'];
    $monto_descuento = $_POST['monto_descuento'];

    // Iniciar la consulta base
    $con_sql = "UPDATE promociones SET 
                nombre='$nombre', 
                descripcion='$descripcion', 
                precio='$precio',
                producto_id='$producto_id',
                estado='$estado',
                fecha_inicio='$fecha_inicio',
                fecha_fin='$fecha_fin',
                porcentaje_descuento='$porcentaje_descuento',
                monto_descuento='$monto_descuento'";

    // Manejar la imagen si se subió una nueva
    if ($_FILES['ima']['name']) {
        $imagen = $_FILES['ima']['name'];
        $tmpImagen = $_FILES['ima']['tmp_name'];
        $carpetaImagenes = 'imagenes/';
        
        if (move_uploaded_file($tmpImagen, $carpetaImagenes . $imagen)) {
            $con_sql .= ", imagen='$imagen'";
        }
    }

    // Completar la consulta con WHERE
    $con_sql .= " WHERE id='$id'";

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
            window.alert('Hubo un error al modificar el registro: " . mysqli_error($db) . "');
        </script>";
    }
}

// Obtener productos para el select
$consulta_productos = "SELECT id, nombre FROM productos WHERE estado = 'disponible'";
$resultado_productos = mysqli_query($db, $consulta_productos);

// Obtener datos de la promoción
$consulta = "SELECT * FROM promociones WHERE id='$id'";
$res = mysqli_query($db, $consulta);
$fila = mysqli_fetch_array($res);
?>
<main class="contenedor seccion">
    <h1>MODIFICAR PROMOCIÓN</h1>
    <a href="listado.php" class="btn btn-primary">Volver</a>
    <form action="actualizar.php?id=<?php echo $fila['id']; ?>" method="post" enctype="multipart/form-data">
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <td>Producto</td>
                <td>
                    <select name="producto_id" class="form-control" required>
                        <option value="">-- Seleccione un Producto --</option>
                        <?php while($producto = mysqli_fetch_assoc($resultado_productos)): ?>
                            <option value="<?php echo $producto['id']; ?>" 
                                <?php echo ($producto['id'] == $fila['producto_id']) ? 'selected' : ''; ?>>
                                <?php echo $producto['nombre']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Imagen</td>
                <td>
                    <?php if($fila['imagen']): ?>
                        <img src="imagenes/<?php echo $fila['imagen']; ?>" alt="Imagen Actual" width="100">
                    <?php endif; ?>
                    <input type="file" name="ima" id="ima" accept="image/jpeg, image/png, image/jpg">
                </td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" class="form-control" name="nom" id="nom" value="<?php echo $fila['nombre']; ?>" required></td>
            </tr>
            <tr>
                <td>Descripción</td>
                <td><textarea class="form-control" name="des" id="des"><?php echo $fila['descripcion']; ?></textarea></td>
            </tr>
            <tr>
                <td>Precio</td>
                <td><input type="number" class="form-control" name="pre" id="pre" value="<?php echo $fila['precio']; ?>" required step="0.01"></td>
            </tr>
            <tr>
                <td>Estado</td>
                <td>
                    <select name="estado" class="form-control" required>
                        <option value="activa" <?php echo ($fila['estado'] == 'activa') ? 'selected' : ''; ?>>Activa</option>
                        <option value="inactiva" <?php echo ($fila['estado'] == 'inactiva') ? 'selected' : ''; ?>>Inactiva</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Fecha de Inicio</td>
                <td><input type="date" class="form-control" name="fecha_inicio" value="<?php echo $fila['fecha_inicio']; ?>" required></td>
            </tr>
            <tr>
                <td>Fecha de Fin</td>
                <td><input type="date" class="form-control" name="fecha_fin" value="<?php echo $fila['fecha_fin']; ?>" required></td>
            </tr>
            <tr>
                <td>Porcentaje de Descuento</td>
                <td><input type="number" class="form-control" name="porcentaje_descuento" value="<?php echo $fila['porcentaje_descuento']; ?>" step="0.01" min="0" max="100"></td>
            </tr>
            <tr>
                <td>Monto de Descuento</td>
                <td><input type="number" class="form-control" name="monto_descuento" value="<?php echo $fila['monto_descuento']; ?>" step="0.01" min="0"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="center">
                        <input type="submit" name="Modificar" id="Modificar" value="Modificar" class="btn btn-primary">
                    </div>
                </td>
            </tr>
        </table>
    </form>
</main>
<?php
//incluirTemplate('footer');
?>