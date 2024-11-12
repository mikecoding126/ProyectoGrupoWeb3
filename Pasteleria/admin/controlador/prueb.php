<?php
require '../../includes/config/database.php';
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
    $tipo_registro = $_POST['tipo_registro'] ?? 'cliente';
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
    if($tipo_registro === 'cliente') {
        if(!$telefono) {
            $errores[] = "El teléfono es obligatorio para clientes";
        }
        if(!$direccion) {
            $errores[] = "La dirección es obligatoria para clientes";
        }
    }

    // Verificar que el email no exista
    $query = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($resultado) > 0) {
        $errores[] = "El email ya está registrado";
    }

    // Si no hay errores, crear el usuario
    if(empty($errores)) {
        // Hashear password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Iniciar transacción
        mysqli_begin_transaction($db);

        try {
            // Insertar usuario
            $query = "INSERT INTO usuarios (nombre, apellido, email, password, tipo_usuario) 
                     VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellido, $email, $passwordHash, $tipo_registro);
            mysqli_stmt_execute($stmt);
            $usuario_id = mysqli_insert_id($db);

            // Si es cliente, insertar en la tabla clientes
            if($tipo_registro === 'cliente') {
                $query = "INSERT INTO clientes (usuario_id, nombre, apellido, telefono, direccion, tipo_cliente) 
                         VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "isssss", $usuario_id, $nombre, $apellido, $telefono, $direccion, $tipo_cliente);
                mysqli_stmt_execute($stmt);
            }

            mysqli_commit($db);

            // Redirigir al login
            echo "<script>
                alert('Usuario registrado correctamente');
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
    <!-- [Head content remains the same] -->
    <style>
        /* [Previous styles remain the same] */
        
        /* Añadir estilos para campos condicionales */
        .campos-cliente {
            display: none;
        }
        .campos-cliente.mostrar {
            display: block;
        }
    </style>
</head>
<body>
    <div class="registro-container">
        <div class="registro-header">
            <div class="logo">🍰</div>
            <h2>Registro de Usuario</h2>
        </div>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST">
            <div class="form-group">
                <label class="form-label">Tipo de Registro:</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="tipo_registro" value="usuario" checked>
                        Usuario Regular
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="tipo_registro" value="cliente">
                        Cliente
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Nombre:</label>
                <input type="text" 
                       class="form-control" 
                       name="nombre" 
                       value="<?php echo htmlspecialchars($nombre); ?>" 
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">Apellido:</label>
                <input type="text" 
                       class="form-control" 
                       name="apellido" 
                       value="<?php echo htmlspecialchars($apellido); ?>" 
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">Email:</label>
                <input type="email" 
                       class="form-control" 
                       name="email" 
                       value="<?php echo htmlspecialchars($email); ?>" 
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">Contraseña:</label>
                <input type="password" 
                       class="form-control" 
                       name="password" 
                       required>
            </div>

            <div class="campos-cliente">
                <div class="form-group">
                    <label class="form-label">Teléfono:</label>
                    <input type="tel" 
                           class="form-control" 
                           name="telefono" 
                           value="<?php echo htmlspecialchars($telefono); ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Dirección:</label>
                    <input type="text" 
                           class="form-control" 
                           name="direccion" 
                           value="<?php echo htmlspecialchars($direccion); ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">Tipo de Cliente:</label>
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" name="tipo_cliente" value="minorista" checked>
                            Minorista
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="tipo_cliente" value="mayorista">
                            Mayorista
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-registro">Registrarse</button>
        </form>
    </div>

    <script>
        // Script para mostrar/ocultar campos de cliente
        document.querySelectorAll('input[name="tipo_registro"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const camposCliente = document.querySelector('.campos-cliente');
                if (this.value === 'cliente') {
                    camposCliente.classList.add('mostrar');
                    // Hacer campos obligatorios
                    camposCliente.querySelectorAll('input').forEach(input => {
                        input.required = true;
                    });
                } else {
                    camposCliente.classList.remove('mostrar');
                    // Quitar obligatoriedad de campos
                    camposCliente.querySelectorAll('input').forEach(input => {
                        input.required = false;
                    });
                }
            });
        });
    </script>
</body>
</html>