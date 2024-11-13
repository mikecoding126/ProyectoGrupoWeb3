<?php
session_start();
require_once('includes/config/database.php');
$db = conectarDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        mysqli_begin_transaction($db);

        // Verificar datos necesarios
        if (!isset($_POST['cliente_id']) || !isset($_SESSION['carrito'])) {
            throw new Exception("Datos incompletos para procesar el pedido");
        }

        $cliente_id = $_POST['cliente_id'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $comentarios = $_POST['comentarios'] ?? '';
        
        // Crear el pedido
        $query = "INSERT INTO pedidos (cliente_id, direccion_envio, telefono, comentarios, estado, fecha_pedido) 
                 VALUES (?, ?, ?, ?, 'nuevo', NOW())";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "isss", $cliente_id, $direccion, $telefono, $comentarios);
        
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error al crear el pedido");
        }
        
        $pedido_id = mysqli_insert_id($db);

        // Insertar detalles del pedido
        foreach ($_SESSION['carrito'] as $producto) {
            $query = "INSERT INTO detalles_pedidos (pedido_id, producto_id, cantidad, precio_unitario) 
                     VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "iiid", 
                $pedido_id, 
                $producto['id'], 
                $producto['cantidad'], 
                $producto['precio']
            );
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error al guardar los detalles del pedido");
            }

            // Actualizar stock
            $query = "UPDATE productos SET stock = stock - ? WHERE id = ? AND stock >= ?";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "iii", 
                $producto['cantidad'], 
                $producto['id'], 
                $producto['cantidad']
            );
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error al actualizar el stock");
            }
        }

        mysqli_commit($db);
        unset($_SESSION['carrito']);

        echo "<script>
            alert('Pedido realizado con éxito');
            window.location.href = 'mis_pedidos.php';
        </script>";

    } catch (Exception $e) {
        mysqli_rollback($db);
        echo "<script>
            alert('Error al procesar el pedido: " . addslashes($e->getMessage()) . "');
            window.location.href = 'carrito.php';
        </script>";
    }
} else {
    header('Location: index.php');
}
?>