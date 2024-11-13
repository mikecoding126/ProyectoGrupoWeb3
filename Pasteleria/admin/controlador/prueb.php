<?php
session_start();
require '../../includes/funciones.php';
require '../../includes/config/database.php';
incluirTemplate('header');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/PASTELERIA/build/css/custom-style.css">
    <style>
        body {
            background-color: #faf3e0;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 40px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header .logo {
            font-size: 50px;
            color: #d35400;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 20px;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }
        .login-button {
            background-color: #d35400;
            border-color: #d35400;
            color: white;
            border-radius: 20px;
            padding: 10px;
            font-size: 16px;
            width: 100%;
        }
        .login-button:hover {
            background-color: #e67e22;
            border-color: #e67e22;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <span class="logo">🍰</span>
                <h2>Registro de Empleado</h2>
            </div>
            <form action="" method="post" class="formulario">
                <fieldset>
                    <div>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
                    </div>
                    <div>
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password_confirm" placeholder="Confirmar Password" required>
                    </div>
                    <div>
                        <select name="rol" class="form-control" required>
                            <option value="">Seleccione Rol</option>
                            <option value="Vendedor">Vendedor</option>
                            <option value="Panadero">Panadero</option>
                            <option value="Cajero">Cajero</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                    </div>
                    <div>
                        <input type="number" class="form-control" name="salario" placeholder="Salario" required>
                    </div>
                    <input type="hidden" name="tipo_usuario" value="empleado">
                    <div>
                        <button type="submit" class="btn login-button" name="registrar">Registrar Empleado</button>
                    </div>
                </fieldset>
            </form>
            <div class="mt-3 text-center">
                <a href="../../index.php" class="btn btn-link">Volver</a>
            </div>
        </div>
    </div>

<?php
if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $rol = $_POST['rol'];
    $salario = $_POST['salario'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Validaciones
    $errores = [];

    if (empty($nombre)) $errores[] = "El nombre es obligatorio";
    if (empty($apellido)) $errores[] = "El apellido es obligatorio";
    if (empty($email)) $errores[] = "El email es obligatorio";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "Email no válido";
    if (empty($password)) $errores[] = "La contraseña es obligatoria";
    if ($password !== $password_confirm) $errores[] = "Las contraseñas no coinciden";
    if (empty($rol)) $errores[] = "El rol es obligatorio";
    if (empty($salario)) $errores[] = "El salario es obligatorio";
    if (!is_numeric($salario) || $salario <= 0) $errores[] = "El salario debe ser un número positivo";

    if (empty($errores)) {
        $db = conectarDB();
        
        try {
            mysqli_begin_transaction($db);

            // Verificar si el email ya existe
            $query = "SELECT id FROM usuarios WHERE email = ?";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultado) > 0) {
                throw new Exception("El email ya está registrado");
            }

            // Insertar en la tabla usuarios
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO usuarios (nombre, apellido, email, password, tipo_usuario) 
                     VALUES (?, ?, ?, ?, ?)";
            
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellido, $email, $password_hash, $tipo_usuario);
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error al registrar usuario");
            }

            $usuario_id = mysqli_insert_id($db);

            // Insertar en la tabla empleados
            $estado = 'activo'; // Por defecto activo
            $query = "INSERT INTO empleados (usuario_id, rol, salario, estado) 
                     VALUES (?, ?, ?, ?)";
            
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "isds", $usuario_id, $rol, $salario, $estado);
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error al registrar empleado");
            }

            mysqli_commit($db);
            echo "<script>
                alert('Empleado registrado exitosamente');
                window.location.href='../../index.php';
            </script>";

        } catch (Exception $e) {
            mysqli_rollback($db);
            echo "<script>
                alert('Error: " . $e->getMessage() . "');
            </script>";
        }
    } else {
        foreach ($errores as $error) {
            echo "<script>
                alert('$error');
            </script>";
        }
    }
}
?>

<?php incluirTemplate('footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>