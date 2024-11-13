<?php
session_start();
require_once('includes/config/database.php');
$db = conectarDB();

// Verificar si hay productos en el carrito
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<script>
        alert('El carrito está vacío');
        window.location.href = 'index.php';
    </script>";
    exit;
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    echo "<script>
        alert('Debe iniciar sesión para realizar un pedido');
        window.location.href = 'login.php';
    </script>";
    exit;
}

// Obtener datos del cliente
$cliente = null;
if (isset($_SESSION['usuario_id'])) {
    $query = "SELECT c.*, u.nombre, u.apellido 
              FROM clientes c 
              JOIN usuarios u ON c.usuario_id = u.id 
              WHERE u.id = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['usuario_id']);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $cliente = mysqli_fetch_assoc($resultado);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Pedido</title>
    <link rel="stylesheet" href="build/css/stylesn.css">
    <style>
        .contenedor {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin: 5px;
        }

        .contenedor .columna {
            flex: 0 1 60%;
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contenedor .columna:first-child {
            margin-right: 5%;
        }

        .contenedor .columna:last-child {
            flex: 0 1 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        h3 {
            text-align: center;
            font-size: 1.2em;
            color: #6c757d;
        }

        input[type="text"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .resumen-pedido {
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #e9ecef;
            color: #495057;
        }

        .table td {
            background-color: #ffffff;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #ffffff;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php require_once('includes/template/header.php'); ?>
    
    <main class="contenedor seccion">
        <h2>Confirmar Pedido</h2>
        
        <div class="contenedor">
            <!-- Columna de datos personales -->
            <div class="columna">
                <form action="procesar_pedido.php" method="post" class="datos-personales">
                    <h3>Datos de Entrega</h3>

                    <?php if($cliente): ?>
                        <div class="campo">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" 
                                   value="<?php echo htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']); ?>" readonly>
                        </div>

                        <div class="campo">
                            <label for="direccion">Dirección de Envío:</label>
                            <input type="text" id="direccion" name="direccion" 
                                   value="<?php echo htmlspecialchars($cliente['direccion']); ?>" required>
                        </div>

                        <div class="campo">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" id="telefono" name="telefono" 
                                   value="<?php echo htmlspecialchars($cliente['telefono']); ?>" required>
                        </div>

                        <input type="hidden" name="cliente_id" value="<?php echo $cliente['id']; ?>">
                    <?php endif; ?>

                    <div class="campo">
                        <label for="comentarios">Comentarios adicionales:</label>
                        <textarea id="comentarios" name="comentarios" rows="4"></textarea>
                    </div>

                    <button type="submit">Confirmar Pedido</button>
                </form>
            </div>

            <!-- Columna de resumen del pedido -->
            <div class="columna">
                <div class="resumen-pedido">
                    <h3>Resumen del Pedido</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
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
                                    <td>Bs.<?php echo number_format($producto['precio'], 2); ?></td>
                                    <td><?php echo $producto['cantidad']; ?></td>
                                    <td>Bs.<?php echo number_format($subtotal, 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                <td><strong>Bs.<?php echo number_format($total, 2); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php require_once('includes/template/footer.php'); ?>
    <script src="build/js/bundle.min.js"></script>
</body>
</html>