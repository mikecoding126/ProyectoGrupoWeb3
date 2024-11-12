<?php
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];
$nombre = '';
$apellido = '';
$email = '';
$telefono = '';
$direccion = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $telefono = mysqli_real_escape_string($db, $_POST['telefono']);
    $direccion = mysqli_real_escape_string($db, $_POST['direccion']);

    if (!$nombre) {
        $errores[] = "El nombre es obligatorio";
    }
    if (!$apellido) {
        $errores[] = "El apellido es obligatorio";
    }
    if (!$email) {
        $errores[] = "El email es obligatorio";
    }
    if (!$password) {
        $errores[] = "La contraseña es obligatoria";
    }
    if (!$telefono) {
        $errores[] = "El teléfono es obligatorio";
    }
    if (!$direccion) {
        $errores[] = "La dirección es obligatoria";
    }

    // Verificar que el email no exista
    $query = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {
        $errores[] = "El email ya está registrado";
    }

    if (empty($errores)) {
        // Hashear password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Iniciar transacción
        mysqli_begin_transaction($db);

        try {
            // Insertar usuario
            $query = "INSERT INTO usuarios (nombre, apellido, email, password, tipo_usuario) 
                     VALUES (?, ?, ?, ?, 'cliente')";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellido, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            $usuario_id = mysqli_insert_id($db);

            // Insertar cliente
            $query = "INSERT INTO clientes (usuario_id, nombre, apellido, telefono, direccion) 
                     VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "issss", $usuario_id, $nombre, $apellido, $telefono, $direccion);
            mysqli_stmt_execute($stmt);

            // Confirmar transacción
            mysqli_commit($db);

            echo "<script>
                alert('Usuario creado correctamente');
                window.location.href = 'login.php';
            </script>";
            exit;
        } catch (Exception $e) {
            mysqli_rollback($db);
            $errores[] = "Error al crear el usuario: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="build/css/stylesn.css">
</head>
<body>
    <?php require_once('includes/template/header.php'); ?>

    <main class="contenedor seccion">
        <h2>Registro de Usuario</h2>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            </div>

            <div class="campo">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" required>
            </div>

            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="campo">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="campo">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required>
            </div>

            <div class="campo">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>

        <div class="acciones">
            <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </main>

    <?php require_once('includes/template/footer.php'); ?>
</body>
</html>