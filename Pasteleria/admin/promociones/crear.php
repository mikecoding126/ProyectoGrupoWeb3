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
    <title>Agregar Nuevo Promoción</title>
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
        <h1>Agregar Nueva Promoción</h1>
        <a href="../index.php" class="btn btn-primary">Volver</a>
        <form method="post" action="registrarpromocion.php" class="formulario" enctype="multipart/form-data">
            <fieldset>
                <legend>Información de la Promoción</legend>
                <div class="form-group">
                    <label for="ima" class="form-label">Imagen:</label>
                    <input type="file" name="ima" id="ima" accept="image/jpeg, image/png, image/jpg" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="nom" class="form-label">Nombre:</label>
                    <input type="text" name="nom" id="nom" placeholder="Nombre Promoción" class="form-control">
                </div>
                <div class="form-group">
                    <label for="des" class="form-label">Descripción:</label>
                    <textarea name="des" id="des" cols="30" rows="10" class="form-control" placeholder="Descripción del Promoción"></textarea>
                </div>
                <div class="form-group">
                    <label for="pre" class="form-label">Precio:</label>
                    <input type="number" name="pre" id="pre" placeholder="Precio Promoción" class="form-control">
                </div>
            </fieldset>
            <input type="submit" value="Añadir Promoción" class="boton boton-verde">
        </form>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php 
    incluirTemplate('footer');
?>
