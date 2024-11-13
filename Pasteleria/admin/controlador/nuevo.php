<?php
  
include("../vista/usuarioNuevo.php");
if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['ema'];
    $password1 = $_POST['pas1'];
    $password2 = $_POST['pas2'];
    $tipo_usuario = $_POST['tipo_usuario']; // Asumiendo que este campo se añade al formulario

    if (strcmp($password1, $password2) == 0) {
        include("../modelo/usuario.php");
        $usuario = new Usuario("", $nombre, $apellido, $email, "", $tipo_usuario);
        $resultado = $usuario->registrarUsuario($nombre, $apellido, $email, $password1, $tipo_usuario);

        if ($resultado) {
            echo "<script>
            alert('Usuario registrado exitosamente');
            location.href='../../index.php';
            </script>";
        } else {
            echo "<script>
            alert('Error al registrar el usuario');
            </script>";
        }
    } else {
        echo "<script>
        alert('Las contraseñas no coinciden');
        </script>";
    }
}
?>