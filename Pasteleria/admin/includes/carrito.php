<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $action = $_POST['action'];

    switch ($action) {
        case 'agregar':
            // Verifica si el producto ya está en el carrito
            $encontrado = false;
            foreach ($_SESSION['carrito'] as &$producto) {
                if ($producto['id'] == $id) {
                    $producto['cantidad']++;
                    $encontrado = true;
                    break;
                }
            }
            if (!$encontrado) {
                // Agrega el nuevo producto al carrito
                $_SESSION['carrito'][] = array(
                    'id' => $id,
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'cantidad' => 1
                );
            }
            break;
        
        case 'remover':
            foreach ($_SESSION['carrito'] as $key => $producto) {
                if ($producto['id'] == $id) {
                    unset($_SESSION['carrito'][$key]);
                    break;
                }
            }
            break;

        case 'actualizar':
            foreach ($_SESSION['carrito'] as &$producto) {
                if ($producto['id'] == $id) {
                    $producto['cantidad'] = $_POST['cantidad'];
                    break;
                }
            }
            break;
    }
}

// Redirige a la página anterior
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>