<?php
session_start();

// Verificar que hay productos en el carrito
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    header('Location: index.php');
    exit();
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
        /* Estilos adicionales para la estructura de dos columnas */
        .contenedor {
            display: flex;
            justify-content: space-between;
            align-items: flex-start; /* Alineación vertical */
            margin: 5px;
        }

        .contenedor .columna {
            flex: 0 1 60%; /* Ancho de las columnas */
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contenedor .columna:first-child {
            margin-right: 5%; /* Espacio entre columnas */
        }

        .contenedor .columna:last-child {
            flex: 0 1 100%; /* Ancho de la segunda columna */
        }

        h2 {
            text-align: center; /* Centrar el título */
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
<?php require_once('includes/template/header.php'); ?>
<body>
<h2></h2>
<h2></h2>
<h2>Confirmar Pedido</h2>
    <main class="contenedor seccion">
       


        <div class="contenedor">
            <!-- Columna de datos personales -->
            <div class="columna">
                <form action="procesar_pedido.php" method="post" class="datos-personales">
                    <h3>Datos Personales</h3>

                    <div class="campo">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>

                    <div class="campo">
                        <label for="direccion">Dirección de Envío:</label>
                        <input type="text" id="direccion" name="direccion" required>
                    </div>

                    <div class="campo">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono" required>
                    </div>

                    <div class="campo">
                        <label for="comentarios">Comentarios:</label>
                        <textarea id="comentarios" name="comentarios" rows="4"></textarea>
                    </div>

                    <button type="submit">Enviar Pedido</button>
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
                <?php foreach ($_SESSION['carrito'] as $producto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td>Bs.<?php echo number_format($producto['precio'], 2); ?></td>
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td>Bs.<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
                </div>
            </div>
        </div>
    </main>
    <script src="build/js/bundle.min.js"></script>
</body>
<?php require_once('includes/template/footer.php'); ?>
</html>
