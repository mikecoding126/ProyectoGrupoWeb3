<?php
    session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }



require '../../includes/config/database.php';
$db = conectarDB();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="container mt-4">
        <h1>Listado de Categorías</h1>
        
        <a href="crear_categoria.php" class="btn btn-success mb-3">Nueva Categoría</a>
        <a href="../index.php" class="btn btn-primary mb-3">Volver</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM categorias ORDER BY categoria";
                $resultado = mysqli_query($db, $query);

                while($categoria = mysqli_fetch_assoc($resultado)):
                ?>
                <tr>
                    <td><?php echo $categoria['id']; ?></td>
                    <td><?php echo $categoria['categoria']; ?></td>
                    <td><?php echo $categoria['estado']; ?></td>
                    <td>
                        <a href="editar_categoria.php?id=<?php echo $categoria['id']; ?>" 
                           class="btn btn-warning btn-sm">Editar</a>
                        <a href="eliminar_categoria.php?id=<?php echo $categoria['id']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Está seguro de eliminar esta categoría?')">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>