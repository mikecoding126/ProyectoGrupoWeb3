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
                $auth = password_verify($p,$usuario['password']);
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
    <style >

</head>
<body>
body {
    background: linear-gradient(135deg, #1b2735, #090a0f);
    font-family: 'Roboto', sans-serif;
    color: #e0e0e0;
}

.login-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(10px);
    text-align: center;
}

.login-header {
    text-align: center;
    margin-bottom: 30px;
}

.login-header .logo {
    font-size: 50px;
    color: #00d4ff;
    margin-bottom: 20px;
    text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff, 0 0 30px #00d4ff;
}

.form-control {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 30px;
    padding: 15px;
    margin-bottom: 15px;
    color: #e0e0e0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: background 0.3s ease;
}

.form-control:focus {
    background: rgba(255, 255, 255, 0.2);
    outline: none;
}

.login-button {
    background-color: #00d4ff;
    border: none;
    color: white;
    border-radius: 30px;
    padding: 15px;
    font-size: 16px;
    width: 100%;
    box-shadow: 0 5px 20px rgba(0, 212, 255, 0.5);
    transition: background 0.3s ease, transform 0.3s ease;
}

.login-button:hover {
    background-color: #00aaff;
    transform: translateY(-2px);
    box-shadow: 0 7px 25px rgba(0, 212, 255, 0.7);
}

.back-link {
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #00d4ff;
    margin-top: 15px;
    transition: color 0.3s ease;
}

.back-link:hover {
    color: #00aaff;
}

.forgot-password {
    color: #999;
    font-size: 14px;
}

.forgot-password:hover {
    color: #00d4ff;
}

.footer-text {
    color: #999;
    font-size: 12px;
    margin-top: 20px;
}

.login-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.5), rgba(0, 122, 255, 0.3));
    border-radius: 15px;
    z-index: -1;
    filter: blur(10px);
}

        
    </style>
<div class="container">
    <div class="login-container">
        <div class="login-header">
            <span class="logo ">🍰 Iniciar Sesión</span>
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
        <p class="footer-text">© 2024 PasteleriaColiita.com - Todos los derechos reservados</p>
    </div>
</div>
            </body>
<?php incluirTemplate('footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>