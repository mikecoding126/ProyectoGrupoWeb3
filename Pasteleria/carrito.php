<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="build/css/stylesn.css">
</head>
<?php require_once('includes/template/header.php'); ?>
<body>
    <main class="contenedor seccion">
        <h2>Carrito de Compras</h2>
        <?php if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['carrito'] as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td>Bs.<?php echo number_format($producto['precio'], 2); ?></td>
                            <td>
                                <form action="admin/includes/carrito.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                    <input type="hidden" name="action" value="actualizar">
                                    <input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>" min="1">
                                    <button type="submit">Actualizar</button>
                                </form>
                            </td>
                            <td>Bs.<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                            <td>
                                <form action="admin/includes/carrito.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                    <input type="hidden" name="action" value="remover">
                                    <button type="submit">Remover</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <form action="confirmar_pedido.php" method="post">
                <button type="submit">Confirmar Pedido</button>
            </form>

        <?php else: ?>
            <p>No hay productos en el carrito.</p>
        <?php endif; ?>
    </main>
    <script src="build/js/bundle.min.js"></script>
</body>
<?php require_once('includes/template/footer.php'); ?>
</html>
