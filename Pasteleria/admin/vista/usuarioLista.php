<?php
require_once '../../includes/funciones.php';
require_once '../../includes/config/database.php';

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
    <a href="usuarioNuevo.php" class="btn btn-primary mb-4">Nuevo Usuario</a>
    <h1>Lista Usuarios</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Tipo Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $db = conectarDB();
        
        // Verificar la conexión
        if (!$db) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        // Consulta adaptada - ajusta los nombres de las columnas según tu base de datos
        $query = "SELECT * FROM usuarios WHERE estado = 'activo'";
        $resultado = mysqli_query($db, $query);

        // Verificar si hay error en la consulta
        if (!$resultado) {
            echo "<div class='alert alert-danger'>Error en la consulta: " . mysqli_error($db) . "</div>";
        } else {
            // Verificar si hay registros
            if (mysqli_num_rows($resultado) > 0) {
                while ($reg = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($reg['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($reg['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($reg['apellido']) . "</td>";
                    echo "<td>" . htmlspecialchars($reg['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($reg['tipo_usuario']) . "</td>";
                    echo "<td>
                            <a href='../controlador/usuarioElimina.php?id=" . $reg['id'] . "' 
                               class='btn btn-danger btn-sm'>Eliminar</a>
                            <a href='../controlador/usuarioModifica.php?cod=" . $reg['id'] . "' 
                               class='btn btn-success btn-sm'>Modificar</a>
                          </td>";
                    echo "</tr>";
                }
               
            } else {
                echo "<tr><td colspan='6' class='text-center'>No hay usuarios registrados</td></tr>";
            }
        }
        
        // Cerrar la conexión
        mysqli_close($db);
        ?>
        </tbody>
    </table>
</main>

<?php incluirTemplate("footer"); ?>