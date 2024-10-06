<?php
session_start();

// Verificar que se haya hecho un POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $comentarios = $_POST['comentarios'];

    // Incluir archivo de conexión a la base de datos usando la ruta absoluta
    require_once('C:/xampp/htdocs/made/Pasteleria/includes/config/database.php');

    // Conectar a la base de datos
    $db = conectarDB();

    // Verificar la conexión
    if (!$db) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Guardar el pedido en la base de datos
    $sql = "INSERT INTO pedidos (nombre, direccion, telefono, comentarios) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nombre, $direccion, $telefono, $comentarios);
    mysqli_stmt_execute($stmt);

    $idPedido = mysqli_insert_id($db); // Obtener el ID del pedido insertado

    // Guardar los detalles del pedido en la base de datos
    foreach ($_SESSION['carrito'] as $producto) {
        $idProducto = $producto['id'];
        $nombreProducto = $producto['nombre'];
        $precio = $producto['precio'];
        $cantidad = $producto['cantidad'];
        $total = $precio * $cantidad;

        $sql = "INSERT INTO detalles_pedido (idPedido, idProducto, nombreProducto, precio, cantidad, total) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "iisidi", $idPedido, $idProducto, $nombreProducto, $precio, $cantidad, $total);
        mysqli_stmt_execute($stmt);
    }

    // Limpiar carrito después de guardar el pedido
    unset($_SESSION['carrito']);

    // Cerrar la conexión a la base de datos
    mysqli_close($db);

    // Redireccionar a la página de confirmación de pedido
    header('Location: confirmar_pedido.php?id=' . $idPedido);
    exit();
} else {
    // Si no es un POST, redireccionar al inicio o manejar el error según tu aplicación
    header('Location: index.php');
    exit();
}
?>
