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
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/283335a286.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Listado de Productos</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        h1 {
            font-size: 2.5rem;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }

        .contenedor {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .table {
            font-size: 1.2rem;
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .img-thumbnail {
            max-width: 100px;
        }

        .text-warning {
            color: #ffc107 !important;
        }
    </style>
</head>
<body>
    <main class="contenedor seccion">
    <a href="../index.php" class="btn btn-primary mb-4">Volver</a>
        <a href="crear.php" class="btn btn-primary mb-4">Nuevo Producto</a>
        <h1 class="mb-4">Productos</h1>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Proveedor</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $con_sql="SELECT p.*,v.* FROM productos p INNER JOIN proveedores v ON p.idProv=v.idProv WHERE estado='Disponible'";
                    $res = mysqli_query($db, $con_sql);
                    while ($reg = $res->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $reg['codProducto']; ?></td>
                        <td> <?php echo $reg['nomProv']." ".$reg['telProv']; ?>
                        <td><img src="imagenes/<?php echo $reg['imagen']; ?>" class="img-thumbnail"></td>
                        <td><?php echo $reg['nombre']; ?></td>
                        <td><?php echo $reg['descripcion']; ?></td>
                        <td class="text-warning font-weight-bold">Bs.-<?php echo $reg['precio']; ?></td>
                        <td><a href="borrar.php?cod=<?php echo $reg['codProducto']; ?>" class="btn btn-danger btn-sm">AGOTADO</a></td>
                        <td><a href="actualizar.php?cod=<?php echo $reg['codProducto']; ?>" class="btn btn-success btn-sm">MODIFICAR</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php incluirTemplate('footer'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>
</body>
</html>
