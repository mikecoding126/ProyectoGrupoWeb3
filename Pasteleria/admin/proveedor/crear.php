<?php
/*
    session_start();
    $auth = $_SESSION['login'];*/
 /*   if(!$auth){*/
      /*  header("Location:/pasteleria");
  /*  }*/
    require '../../includes/config/database.php';
    $db = conectarDB();

    require '../../includes/funciones.php';
 /*   incluirTemplate('header');*/
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
    <title>Agregar Nuevo Proveedor</title>
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
        .form-control {
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
<main class="contenedor">
    <h1>Crear</h1>
    <a href="../../index.php" class="btn boton-verde mb-3">Volver</a>
    <form action="registrarVendedor.php" method="post" class="formulario" enctype="multipart/form-data">
        <fieldset>
            <legend>Información general</legend>
            <div class="mb-3">
                <label for="nom" class="form-label">Nombre</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Teléfono</label>
                <input type="number" name="tel" id="tel" class="form-control" placeholder="Teléfono" required>
            </div>
            <div class="mb-3">
                <label for="corr" class="form-label">Correo</label>
                <input type="email" name="corr" id="corr" class="form-control" placeholder="Correo" required>
            </div>
            <div class="mb-3">
                <label for="dir" class="form-label">Dirección</label>
                <input type="text" name="dir" id="dir" class="form-control" placeholder="Dirección" required>
            </div>
        </fieldset>
        <div class="d-flex justify-content-between">
            <input type="submit" value="Registrar Proveedor" class="btn btn-primary">
        </div>
    </form>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-q91u/38pFqojlD8u2qzTxRj9kk+/9A9E8z6eM5S/IRVYcv9YVD3KeI2M9Tdy4xTq" crossorigin="anonymous"></script>
</body>
</html>

<?php
    // incluirTemplate("footer");
?>
