<?php 
   /* session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }*/
    require '../../includes/config/database.php';
    $db = conectarDB();
    require '../../includes/funciones.php';
incluirTemplate('header');

    $consulta_productos = "SELECT id, nombre, precio FROM productos WHERE estado = 'disponible'";
    $resultado_productos = mysqli_query($db, $consulta_productos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Agregar Nueva Promoción</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding-top: 20px;
        }
        .contenedor {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            font-size: 2.5rem;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control, .form-control-file {
            margin-bottom: 15px;
        }
        .boton-verde {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .boton-verde:hover {
            background-color: #218838;
        }
        .btn {
            margin-bottom: 20px;
        }
        fieldset {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        legend {
            padding: 0 10px;
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <main class="contenedor seccion">
        <h1>Agregar Nueva Promoción</h1>
        <a href="../index.php" class="btn btn-primary">Volver</a>

        <form method="post" action="registrarpromocion.php" class="formulario" enctype="multipart/form-data">
            <fieldset>
                <legend>Información de la Promoción</legend>

                <div class="form-group">
                    <label for="producto_id" class="form-label">Producto:</label>
                    <select name="producto_id" id="producto_id" class="form-control" required>
                        <option value="">-- Seleccione un Producto --</option>
                        <?php while($producto = mysqli_fetch_assoc($resultado_productos)): ?>
                            <option value="<?php echo $producto['id']; ?>">
                                <?php echo $producto['nombre'] . ' - $' . $producto['precio']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ima" class="form-label">Imagen:</label>
                    <input type="file" name="ima" id="ima" accept="image/jpeg, image/png, image/jpg" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="nom" class="form-label">Nombre de la Promoción:</label>
                    <input type="text" name="nom" id="nom" placeholder="Nombre de la Promoción" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="des" class="form-label">Descripción:</label>
                    <textarea name="des" id="des" class="form-control" placeholder="Descripción de la Promoción" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="pre" class="form-label">Precio Promocional:</label>
                    <input type="number" name="pre" id="pre" placeholder="Precio con Descuento" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="porcentaje_descuento" class="form-label">Porcentaje de Descuento (%):</label>
                    <input type="number" name="porcentaje_descuento" id="porcentaje_descuento" 
                           placeholder="Ej: 15" class="form-control" step="0.01" min="0" max="100">
                </div>

                <div class="form-group">
                    <label for="monto_descuento" class="form-label">Monto de Descuento ($):</label>
                    <input type="number" name="monto_descuento" id="monto_descuento" 
                           placeholder="Ej: 100.00" class="form-control" step="0.01" min="0">
                </div>

                <div class="form-group">
                    <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="fecha_fin" class="form-label">Fecha de Fin:</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                </div>
            </fieldset>

            <input type="submit" value="Crear Promoción" class="boton boton-verde">
        </form>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>