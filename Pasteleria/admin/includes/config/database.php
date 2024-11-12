
<?php
if (!function_exists('conectarDB')) {
    function conectarDB() {
        $db = mysqli_connect('localhost', 'root', '', 'pasteleriac');
        if (!$db) {
            echo "Error: No se pudo conectar a MySQL.";
            echo "errno de depuración: " . mysqli_connect_errno();
            echo "error de depuración: " . mysqli_connect_error();
            exit;
        }
        return $db;
    }
}
?>