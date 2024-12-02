<?php
require './includes/config/database.php';
$db = conectarDB();

// Validar que el formulario se envió por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar los datos recibidos
    $nombre = mysqli_real_escape_string($db, $_POST['nom']);
    $apellido = mysqli_real_escape_string($db, $_POST['ape']);
    $correo = mysqli_real_escape_string($db, $_POST['cor']);
    $telefono = mysqli_real_escape_string($db, $_POST['tel']);
    $mensaje = mysqli_real_escape_string($db, $_POST['men']);

    // Validar que los campos no estén vacíos
    $errores = [];
    if(!$nombre) {
        $errores[] = "El nombre es obligatorio";
    }
    if(!$apellido) {
        $errores[] = "El apellido es obligatorio";
    }
    if(!$correo) {
        $errores[] = "El correo es obligatorio";
    }
    if(!$telefono) {
        $errores[] = "El teléfono es obligatorio";
    }
    if(!$mensaje) {
        $errores[] = "El mensaje es obligatorio";
    }

    // Si no hay errores, insertar en la base de datos
    if(empty($errores)) {
        $query = "INSERT INTO contacto (nombre, apellido, correo, telefono, mensaje) 
                 VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$mensaje')";

        $resultado = mysqli_query($db, $query);
        
        if($resultado) {
            echo "Registro exitoso, no poneres en contacto muy pronto";
            // Redirigir al index con mensaje de éxito
            header('Location: ./index.php?mensaje=enviado');
            exit;
        } else {
            // Redirigir al index con mensaje de error
            header('Location: ./index.php?mensaje=error');
            exit;
        }
    }
}
?>