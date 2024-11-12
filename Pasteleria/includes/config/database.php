<?php
function conectarDB() {
    $db = new mysqli('localhost', 'root', '', 'pasteleriac');
    if ($db->connect_error) {
        die('Error de conexión: ' . $db->connect_error);
    }
    $db->set_charset("utf8");
    return $db;
}