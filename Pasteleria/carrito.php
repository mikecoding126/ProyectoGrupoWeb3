<?php

require 'includes/config/database.php';
$db = conectarDB();

require 'includes/funciones.php';
incluirTemplate('header');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="build/css/stylesn.css">
    <style>
        .table-responsive {
            margin: 2rem 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .table {
            margin-bottom: 0;
        }
        .table thead th {
            background-color: #343a40;
            color: white;
            border: none;
            padding: 1rem;
        }
        .table td {
            padding: 1rem;
            vertical-align: middle;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .total-row {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .acciones-carrito {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .carrito-vacio {
            text-align: center;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 10px;
            margin: 2rem 0;
        }
    </style>
</head>
<body>
    <main class="contenedor seccion">
        <h1 class="mb-4">Carrito de Compras</h1>
        
        <?php if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;
                        foreach ($_SESSION['carrito'] as $producto):
                            $subtotal = $producto['precio'] * $producto['cantidad'];
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                <td>
                                    <form action="admin/includes/carrito.php" method="post" style="display: inline-flex; gap: 0.5rem;">
                                        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                        <input type="hidden" name="action" value="actualizar">
                                        <input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>" 
                                               min="1" style="width: 70px;" class="form-control">
                                        <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                                    </form>
                                </td>
                                <td>Bs.-<?php echo number_format($producto['precio'], 2); ?></td>
                                <td>Bs.-<?php echo number_format($subtotal, 2); ?></td>
                                <td>
                                    <form action="admin/includes/carrito.php" method="post" style="display: inline;">
                                        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                        <input type="hidden" name="action" value="remover">
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="total-row">
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td colspan="2"><strong>Bs.-<?php echo number_format($total, 2); ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="acciones-carrito">
                <a href="productos.php" class="btn btn-secondary">Seguir Comprando</a>
                <a href="confirmar_pedido.php" class="btn btn-primary">Proceder al Pago</a>
            </div>
        <?php else: ?>
            <div class="carrito-vacio">
                <p>No hay productos en el carrito.</p>
                <a href="productos.php" class="btn btn-primary">Ver Productos</a>
            </div>
        <?php endif; ?>
    </main>

    <?php incluirTemplate('footer'); ?>
    <script src="build/js/bundle.min.js"></script>
</body>
</html>