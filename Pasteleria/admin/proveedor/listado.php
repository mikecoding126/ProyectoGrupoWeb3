<!-- <?php
    // session_start();
    // $auth = $_SESSION['login'];
    // if(!$auth){
    //     header("Location:/bienesPHP");
    // }
    // require "includes/config/database.php";
    // $db = conectarDB();

    // require '../../includes/funciones.php';
    // incluirTemplate('header');

    /*
    session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }*/
    require '../../includes/config/database.php';
    $db = conectarDB();

    require '../../includes/funciones.php';
    incluirTemplate('header');

?> -->
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
<main class = "contenedor seccion">
    <h1>Listado vendedores</h1>
    <a href="../index.php" class="btn btn-primary mb-4">Volver</a>
    <a href="crear.php/" class="btn btn-primary mb-4">Nuevo Proveedor</a>
    <h3>
        <table class="table table-striped">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Direccion</th>
                <th colspan = "2">Acciones</th>
            </thead>
            <tbody>
                <?php
                    $con_sql = 'Select * from proveedores';
                    $res = mysqli_query($db,$con_sql);
                    while($reg=$res ->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $reg['id']?></td>
                    <td><?php echo $reg['nombre']?></td>
                    <td><?php echo $reg['telefono']?></td>
                    <td><?php echo $reg['correo']?></td>
                    <td><?php echo $reg['direccion']?></td>
                    <td><a href=""></a></td>
                    <td><a href="borrar.php?cod=<?php echo $reg['id'];?>" class="btn btn-danger">Eliminar</a></td>
                    <td><a href="actualizar.php?cod=<?php echo $reg['id'];?>" class="btn btn-success">Actualizar</a></td>
                </tr>
                
                <?php
                    }
                ?>
                 <td colspan="3">
                <div align="center">
            </td>
            </tbody>
        </table>
    </h3>
</main>
<!-- <?php
    incluirTemplate("footer");
?> -->