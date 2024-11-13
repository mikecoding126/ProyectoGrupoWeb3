<?php

require '../../includes/config/database.php';
$db = conectarDB();

$errores = [];
$email = '';
$telefono = '';
$direccion = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Datos para la tabla usuarios
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    
    // Datos para la tabla clientes
    $telefono = mysqli_real_escape_string($db, $_POST['telefono']);
    $direccion = mysqli_real_escape_string($db, $_POST['direccion']);
    $tipo_cliente = $_POST['tipo_cliente'] ?? 'minorista';

    // Validaciones
    if(!$nombre) {
        $errores[] = "El nombre es obligatorio";
    }
    if(!$apellido) {
        $errores[] = "El apellido es obligatorio";
    }
    if(!$email) {
        $errores[] = "El email es obligatorio";
    }
    if(!$password) {
        $errores[] = "La contraseña es obligatoria";
    }
    if(!$telefono) {
        $errores[] = "El teléfono es obligatorio";
    }
    if(!$direccion) {
        $errores[] = "La dirección es obligatoria";
    }

    // Verificar email único
    $query = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($resultado) > 0) {
        $errores[] = "El email ya está registrado";
    }

    if(empty($errores)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        mysqli_begin_transaction($db);

        try {
            // Insertar en usuarios
            $query = "INSERT INTO usuarios (nombre, apellido, email, password, tipo_usuario) 
                     VALUES (?, ?, ?, ?, 'cliente')";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellido, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            $usuario_id = mysqli_insert_id($db);

            // Insertar en clientes
            $query = "INSERT INTO clientes (usuario_id, telefono, direccion, tipo_cliente) 
                     VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "isss", $usuario_id, $telefono, $direccion, $tipo_cliente);
            mysqli_stmt_execute($stmt);

            mysqli_commit($db);

            echo "<script>
                alert('Registro exitoso. Por favor, inicia sesión.');
                window.location.href = '../../login.php';
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
    <title>Registro de Cliente - Pastelería</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Mantener los estilos anteriores */
        .registro-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 2rem;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(255, 192, 203, 0.2);
        }

        .registro-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #ffd6e0;
            border-radius: 10px;
        }

        .btn-registro {
            width: 100%;
            padding: 1rem;
            background: #ff8fab;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .alerta {
            padding: 0.8rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            text-align: center;
        }

        .error {
            background: #ffe5e5;
            color: #ff4444;
        }
    </style>
</head>
<body>
    <div class="registro-container">
        <div class="registro-header">
            <h2>Registro de Cliente</h2>
        </div>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST">
            <!-- Datos de Usuario -->
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>

            <div class="form-group">
                <label>Apellido:</label>
                <input type="text" class="form-control" name="apellido" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="email" 
                       value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <!-- Datos de Cliente -->
            <div class="form-group">
                <label>Teléfono:</label>
                <input type="tel" class="form-control" name="telefono" 
                       value="<?php echo htmlspecialchars($telefono); ?>" required>
            </div>

            <div class="form-group">
                <label>Dirección:</label>
                <input type="text" class="form-control" name="direccion" 
                       value="<?php echo htmlspecialchars($direccion); ?>" required>
            </div>

            <div class="form-group">
                <label>Tipo de Cliente:</label>
                <div style="display: flex; gap: 1rem;">
                    <label>
                        <input type="radio" name="tipo_cliente" value="minorista" checked> 
                        Minorista
                    </label>
                    <label>
                        <input type="radio" name="tipo_cliente" value="mayorista"> 
                        Mayorista
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-registro">Registrarse</button>
        </form>
    </div>
</body>
</html>