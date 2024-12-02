<?php
    require 'includes/config/database.php';
    $db = conectarDB();
    
    $errores = [];
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = filter_var(mysqli_real_escape_string($db, $_POST['em']), FILTER_SANITIZE_EMAIL);
        $password = mysqli_real_escape_string($db, $_POST['pas']);
        
        if(!$email) {
            $errores[] = "El email debe tener datos"; 
        }
        if(!$password) {
            $errores[] = "El password es obligatorio";
        }
        
        if(empty($errores)) {
            // Verificar usuario
            $query = "SELECT * FROM usuarios WHERE email = ? AND estado = 'activo'";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            if($resultado->num_rows) {
                $usuario = mysqli_fetch_assoc($resultado);
                
                if(password_verify($password, $usuario['password'])) {
                    // Iniciar sesión
                    session_start();
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
                    
                    // Redirigir según tipo de usuario
                    if($usuario['tipo_usuario'] === 'empleado') {
                        header('Location: admin/index.php');
                    } else {
                        header('Location: carrito.php');
                    }
                    exit();
                } else {
                    $errores[] = "Password Incorrecto";
                }
            } else {
                $errores[] = "El Usuario no Existe";
            }
        }
    }

    require 'includes/funciones.php';
    incluirTemplate('header');
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Pastelería</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 2rem;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(255, 192, 203, 0.2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header .logo {
            font-size: 2.5rem;
            color: #ff8fab;
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 2px solid #ffd6e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #ff8fab;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 143, 171, 0.3);
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: #ff8fab;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background: #ff7096;
        }

        .alerta {
            padding: 0.8rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .error {
            background: #ffe5e5;
            color: #ff4444;
        }

        .registro-link {
            text-align: center;
            margin-top: 1rem;
        }

        .registro-link a {
            color: #ff8fab;
            text-decoration: none;
        }

        .registro-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">🍰</div>
            <h2>Iniciar Sesión</h2>
        </div>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST">
            <input type="email" 
                   class="form-control" 
                   name="em" 
                   placeholder="Email"
                   value="<?php echo isset($_POST['em']) ? htmlspecialchars($_POST['em']) : ''; ?>">

            <input type="password" 
                   class="form-control" 
                   name="pas" 
                   placeholder="Contraseña">

            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>
        <div class="registro-link">
    <a href="admin/controlador/usuarioNuevo.php">¿No tienes cuenta? Regístrate aquí</a>
</div>
 
<div class="recuperar-link">
    <a href="./contacto.php" onclick="contactarAdmin(); return true;">
        ¿Olvidaste tu contraseña?
    </a>
</div>

<script>
function contactarAdmin() {
    alert('Por favor contacta con el administrador para restablecer tu contraseña: adminPateleriaCollita@gmail.com');
    
}
</script>
</div>
            </body>
</script>
</body>
</html>

<?php incluirTemplate('footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

