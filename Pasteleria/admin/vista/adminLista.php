<?php
 
require '../../includes/funciones.php';
incluirTemplate('header');
?>
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
<main class="contenedor seccion">
    <a href="../index.php" class="btn btn-primary mb-4">Volver</a>
    <a href="usuarioNuevoAdmin.php" class="btn btn-primary mb-4">Nuevo Administrador</a>
    <h1>Lista Administradores</h1>
    <table class="table table-striped">
        <tr>
            <td>ID</td>
            <td>EMAIL</td>
        </tr>
        <?php
        require '../../includes/config/database.php';
        $db = conectarDB();
        $con_sql = "select * from usuariosc";
        $res = mysqli_query($db, $con_sql);
        while ($reg = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>" . $reg['idUsuario'] . "</td>";
            echo "<td>" . $reg['email'] . "</td>";
            echo "<td><a href='../controlador/usuarioElimina.php?cod=" . $reg['idUsuario'] . "' class='btn btn-danger'>Eliminar</a></td>";
            echo "<td><a href='../controlador/usuarioModifica.php?cod=" . $reg['idUsuario'] . "' class='btn btn-success'>Modificar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</main>