<?php
    require 'includes/config/database.php';
    $db = conectarDB();
    //Funciones
    $errores=[];
    $cont = 0;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $e = mysqli_real_escape_string($db,$_POST['em']);
        $p = mysqli_real_escape_string($db,$_POST['pas']);
        if(!$e){
            $errores[] = "El email debe tener datos"; 
        }
        if(!$p){
            $errores[] = "El password es obligatorio";
        }
        if(empty($errores)){
            $con_sql = "SELECT * FROM usuariosd WHERE email='$e'";
            $res = mysqli_query($db,$con_sql);
            if($res -> num_rows){
                echo "uno";
                $usuario = mysqli_fetch_array($res);
                $auth = password_verify($p,$usuario['pasword']);
                if($auth){
                    session_start();
                    $_SESSION['usuario']=$usuario['email'];
                    $_SESSION['login'] = true;
                    echo "<pre>";
                    var_dump($_SESSION);
                    "</pre>";
                    header("Location:index.php");
                    exit();
                }
                else{
                    $errores[] = "El password es incorrecto";
                }
            }
            else{
                $con_sql2 = "SELECT * FROM usuariosc WHERE email='$e'";
                $res2 = mysqli_query($db, $con_sql2);
                if ($res2->num_rows) {
                    echo "dos";
                    $usuario = mysqli_fetch_array($res2);
                    $auth = password_verify($p, $usuario['pasword']);
                    if ($auth) {
                        session_start();
                        $_SESSION['usuario'] = $usuario['email'];
                        $_SESSION['login'] = true;
                        header("Location: admin");
                        exit();
                    } else {
                        $errores[] = "El password es incorrecto";
                    }
                } else {
                    $errores[] = "No existe el usuario";
                }   
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
    <title>Iniciar Sesión para Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/PASTELERIA/build/css/custom-style.css"> <!-- Asegúrate de que esta ruta es correcta -->
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
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #d35400;
            margin-top: 15px;
        }
        .back-link i {
            margin-right: 5px;
        }
        .forgot-password {
            color: #999;
            font-size: 14px;
        }
        .forgot-password:hover {
            color: #d35400;
        }
        .footer-text {
            color: #999;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="login-container">
        <div class="login-header">
            <span class="logo">🍰 Iniciar Sesión</span>
        </div>
        <?php
            foreach($errores as $error): ?>
                <div class = "alerta error">
                    <?php echo $error;?>
                </div>
        <?php endforeach;?>
        <form action="" method="post">
            <div>
                <input type="email" class="form-control" name="em" placeholder="Email" required>
            </div>
            <div>
                <input type="password" class="form-control" name="pas" placeholder="Password" required>
            </div>
            <div>
                <button type="submit" class="btn login-button">Login</button>
            </div>
            <p></p>
            <div>
                <a href="admin/vista/usuarioNuevo.php"> registrarse</a>
            </div>
        </form>
        <p class="footer-text">© 2024 PasteleriaEsencia.com - Todos los derechos reservados</p>
    </div>
</div>

<?php incluirTemplate('footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>