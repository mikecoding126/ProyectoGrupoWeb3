<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

function agregarAlCarrito($id, $nombre, $precio) {
    $producto = array(
        'id' => $id,
        'nombre' => $nombre,
        'precio' => $precio,
    );

    array_push($_SESSION['carrito'], $producto);
}

function eliminarDelCarrito($id) {
    foreach ($_SESSION['carrito'] as $key => $producto) {
        if ($producto['id'] == $id) {
            unset($_SESSION['carrito'][$key]);
            break;
        }
    }

    $_SESSION['carrito'] = array_values($_SESSION['carrito']);
}

function vaciarCarrito() {
    unset($_SESSION['carrito']);
}
?>
