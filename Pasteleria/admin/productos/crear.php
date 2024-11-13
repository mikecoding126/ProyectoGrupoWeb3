<?php 
    session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }
    require '../../includes/config/database.php';
    $db = conectarDB();

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Agregar Nuevo Producto</title>
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
        <h1>Agregar nuevo producto</h1>
        <a href="../index.php" class="btn btn-primary">Volver</a>
        <form method="post" action="registrarproducto.php" class="formulario" enctype="multipart/form-data">
            <fieldset>
                <legend>Información del Producto</legend>
                <div class="form-group mb-3">
    <label for="cod" class="form-label">Código de producto:</label>
    <input type="text" 
           name="cod" 
           id="cod" 
           placeholder="Código del producto" 
           class="form-control" 
           required 
           pattern="[A-Za-z0-9]+" 
           title="Solo se permiten letras y números"
           onkeyup="this.value = this.value.toUpperCase()">
    <small class="form-text text-muted">El código debe ser único y solo puede contener letras y números</small>
</div>
                <div class="form-group mb-3">
                    <label for="categoria_id" class="form-label">Categoría:</label>
                    <select name="categoria_id" id="categoria_id" class="form-select" required>
                        <option value="">-- Seleccione una categoría --</option>
                        <?php
                        $query_categorias = "SELECT * FROM categorias WHERE estado = 'activo' ORDER BY categoria";
                        $resultado_categorias = mysqli_query($db, $query_categorias);
                        while ($categoria = mysqli_fetch_assoc($resultado_categorias)) {
                            echo "<option value='{$categoria['id']}'>{$categoria['categoria']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="ima" class="form-label">Imagen:</label>
                    <input type="file" name="ima" id="ima" accept="image/jpeg, image/png, image/jpg" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="nom" class="form-label">Nombre:</label>
                    <input type="text" name="nom" id="nom" placeholder="Nombre Producto" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="des" class="form-label">Descripción:</label>
                    <textarea name="des" id="des" class="form-control" placeholder="Descripción del Producto" rows="5"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="pre" class="form-label">Precio:</label>
                    <div class="input-group">
                        <span class="input-group-text">Bs.</span>
                        <input type="number" name="pre" id="pre" placeholder="0.00" class="form-control" step="0.01" min="0" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="st" class="form-label">Stock:</label>
                    <input type="number" name="st" id="st" placeholder="Cantidad disponible" class="form-control" min="0" required>
                </div>
            </fieldset>
            
            <fieldset class="mt-4">
                <legend>Proveedor</legend>
                <div class="form-group mb-3">
                    <select name="pro" id="pro" class="form-select" required>
                        <option value="">-- Seleccione un proveedor --</option>
                        <?php
                        $con_sql = "SELECT * FROM proveedores WHERE estado = 'no_promocionado' ORDER BY nombre";
                        $res = mysqli_query($db, $con_sql);
                        while ($reg = $res->fetch_assoc()) {
                            echo "<option value='{$reg['id']}'>";
                            echo htmlspecialchars($reg['nombre']) . " - Tel: " . htmlspecialchars($reg['telefono']);
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
            </fieldset>

            <div class="d-grid gap-2">
                <input type="submit" value="Añadir Producto" class="btn btn-success btn-lg">
            </div>
        </form>
    </main>
</body>
</html>
<?php 
    incluirTemplate('footer');
?>
