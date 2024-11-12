<?php
session_start();
$auth = $_SESSION['login'];
if (!$auth) {
    header("Location:/pasteleria/login.php");
    exit();
}

require '../../includes/config/database.php';
$db = conectarDB();

require '../../includes/funciones.php';
incluirTemplate('header');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Mismos estilos y enlaces -->
</head>
<body>
<main class="contenedor seccion">
    <h1 class="mb-4">Carrito de Compras</h1>
    <?php if (!empty($_SESSION['carrito'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
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
                foreach ($_SESSION['carrito'] as $producto) {
                    $subtotal = $producto['precio'] * $producto['cantidad'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td>Bs.-<?php echo $producto['precio']; ?></td>
                    <td>Bs.-<?php echo $subtotal; ?></td>
                    <td><a href="eliminar_carrito.php?cod=<?php echo $producto['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" class="text-right font-weight-bold">Total</td>
                    <td colspan="2" class="text-warning font-weight-bold">Bs.-<?php echo $total; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <p>No hay productos en el carrito.</p>
    <?php endif; ?>
</main>

<?php incluirTemplate('footer'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>
</body>
</html>
