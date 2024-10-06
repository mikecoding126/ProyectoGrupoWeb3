<?php
    // session_start();
    // $auth = $_SESSION['login'];
    // if(!$auth){
    //     header('Location:/');
    // }
    require '../../includes/funciones.php';
    incluirTemplate('header');
        $cod = $_GET['cod'];
        include "../modelo/usuario.php";
        $usu = new Usuario("","","");
        $r = $usu -> buscarUsuario($cod);
        $reg = mysqli_fetch_array($r);
        if(isset($_POST['modificar'])){
            $p1 = $_POST['pas1'];
            $p2 = $_POST['pas2'];
            if(strcmp($p1,$p2)==0){
                $pashash = password_hash($p1,PASSWORD_DEFAULT);
                $usu = new Usuario("","","");
                $r = $usu -> modificarUsuario($cod,$pashash);
                if($r){
                    echo "<script>
                        alert('Se modifico');
                        location.href='usuarioLista.php';
                    </script>";
                }else{
                    echo "<script>
                        alert('No se modifico');
                        location.href='usuarioLista.php';
                    </script>";
                }
            }else{
                echo "Las contraseñas deben ser iguales";
            }
        }
?>
<form action="" method="post">
    <h1>Modificar Contraseña</h1>
    <fieldset>
        <legend>Informacion General</legend>
        <label for="">Email</label>
        <input type="email" name="ema" id="ema" value="<?php echo $reg['email']?>">
        <label for="">Escriba contraseña</label>
        <input type="password" name="pas1" id="pas1">
        <label for="">Confirma Contraseña</label>
        <input type="password" name="pas2" id="pas2">

        <br><br>

        <input type="submit" name="modificar" value="Modificar contraseña" class="btn btn-primary">
        <a href="../controlador/usuarioLista.php" class ="btn btn-danger">Cancelar</a>

    </fieldset>
</form>
<?php
    incluirTemplate("footer");
?>

