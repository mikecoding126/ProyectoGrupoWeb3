<?php
session_start();
$auth = $_SESSION['login'];
if (!$auth) {
    header("Location:/pasteleria");
}
require_once('../../includes/config/database.php');
$db = conectarDB();

require_once('../../includes/funciones.php');
incluirTemplate('header');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/283335a286.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Listado de Pedidos</title>
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
        <a href="http://localhost/made/Pasteleria/admin/index.php" class="btn btn-primary mb-4">Volver</a>
        <h1 class="mb-4">Pedidos</h1>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID Pedido</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Comentarios</th>
                        <th>Fecha</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlPedidos = "SELECT * FROM pedidos";
                    $resultPedidos = mysqli_query($db, $sqlPedidos);
                    while ($pedido = mysqli_fetch_assoc($resultPedidos)) {
                    ?>
                    <tr>
                        <td><?php echo $pedido['idPedido']; ?></td>
                        <td><?php echo htmlspecialchars($pedido['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['telefono']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($pedido['comentarios'])); ?></td>
                        <td><?php echo $pedido['fecha']; ?></td>
                        <td>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $idPedido = $pedido['idPedido'];
                                        $sqlDetalles = "SELECT * FROM detalles_pedido WHERE idPedido = $idPedido";
                                        $resultDetalles = mysqli_query($db, $sqlDetalles);
                                        while ($detalle = mysqli_fetch_assoc($resultDetalles)) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($detalle['nombreProducto']); ?></td>
                                            <td>Bs.<?php echo number_format($detalle['precio'], 2); ?></td>
                                            <td><?php echo $detalle['cantidad']; ?></td>
                                            <td>Bs.<?php echo number_format($detalle['total'], 2); ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </td>
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
<?php
// Cerrar la conexión a la base de datos
mysqli_close($db);
?>
