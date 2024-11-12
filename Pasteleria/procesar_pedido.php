<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('includes/config/database.php');
    $db = conectarDB();

    if (!$db) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Verificar si el usuario está logueado y es cliente
    if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] !== 'cliente') {
        echo "<script>
            alert('Debe iniciar sesión como cliente para realizar un pedido');
            window.location.href = 'login.php';
        </script>";
        exit;
    }

    // Obtener el ID del cliente
    $usuario_id = $_SESSION['usuario_id'];
    $query = "SELECT id FROM clientes WHERE usuario_id = ? AND estado = 'activo'";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "i", $usuario_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $cliente = mysqli_fetch_assoc($resultado);

    if (!$cliente) {
        echo "<script>
            alert('Error: Cliente no encontrado o inactivo');
            window.location.href = 'index.php';
        </script>";
        exit;
    }

    // Crear el pedido
    $query = "INSERT INTO pedidos (cliente_id, estado) VALUES (?, 'nuevo')";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "i", $cliente['id']);
    mysqli_stmt_execute($stmt);
    $pedido_id = mysqli_insert_id($db);

    // Guardar los detalles del pedido
    foreach ($_SESSION['carrito'] as $producto) {
        $producto_id = $producto['id'];
        $cantidad = $producto['cantidad'];
        $precio = $producto['precio'];

        $query = "INSERT INTO detalles_pedidos (pedido_id, producto_id, cantidad, precio_unitario) 
                 VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "iiid", $pedido_id, $producto_id, $cantidad, $precio);
        mysqli_stmt_execute($stmt);

        // Actualizar stock del producto
        $query = "UPDATE productos SET stock = stock - ? WHERE id = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "ii", $cantidad, $producto_id);
        mysqli_stmt_execute($stmt);
    }

    // Limpiar carrito
    unset($_SESSION['carrito']);

    // Redireccionar
    header('Location: confirmar_pedido.php?id=' . $pedido_id);
    exit();
}
?>
