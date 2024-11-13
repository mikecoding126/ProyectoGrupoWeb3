<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = [];

// Destruir la cookie de sesión si existe
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Destruir la sesión
session_destroy();

// Redireccionar a la página principal
header('Location: index.php');
exit; // Asegurar que el script se detenga después de la redirección
?>