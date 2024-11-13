<?php
session_start();
require '../../includes/funciones.php';
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
            text-align: center;
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
                <span class="logo">🍰 Registro de Empleado</span>
            </div>
            <form action="../controlador/empleadoController.php" method="post" class="formulario">
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
                        <input type="text" class="form-control" name="cargo" placeholder="Cargo" required>
                    </div>
                    <div>
                        <input type="tel" class="form-control" name="telefono" placeholder="Teléfono" required>
                    </div>
                    <input type="hidden" name="tipo_usuario" value="empleado">
                    <div>
                        <button type="submit" class="btn login-button" name="registrar">Registrar Empleado</button>
                    </div>
                </fieldset>
            </form>
            <div class="mt-3">
                <a href="../../login.php" class="btn btn-link">Volver</a>
            </div>
        </div>
    </div>

    <?php incluirTemplate('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>