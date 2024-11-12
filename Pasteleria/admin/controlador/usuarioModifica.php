<?php
// session_start();
// $auth = $_SESSION['login'];
// if(!$auth){
//     header('Location:/');
// }
require '../../includes/funciones.php';
incluirTemplate('header');

$cod = $_GET['cod'];
include("../modelo/usuario.php");
$usu = new Usuario("", "", "", "", "", "");
$r = $usu->buscarUsuario($cod);
$reg = mysqli_fetch_array($r);

if (isset($_POST['modificar'])) {
    $password1 = $_POST['pas1'];
    $password2 = $_POST['pas2'];
    if (strcmp($password1, $password2) == 0) {
        $usu = new Usuario("", "", "", "", "", "");
        $r = $usu->modificarUsuario($cod, $password1);
        if ($r) {
            echo "<script>
            alert('Se modificó');
            location.href='usuarioLista.php';
            </script>";
        } else {
            echo "<script>
            alert('No se modificó');
            location.href='usuarioLista.php';
            </script>";
        }
    } else {
        echo "Las contraseñas deben ser iguales";
    }
}
?>
<form action="" method="post">
    <h1>Modificar Contraseña</h1>
    <fieldset>
        <legend>Informacion General</legend>
        <label for="">Email</label>
        <input type="email" name="ema" id="ema" value="<?php echo $reg['email'] ?>" readonly>
        <label for="">Escriba contraseña</label>
        <input type="password" name="pas1" id="pas1" required>
        <label for="">Confirma Contraseña</label>
        <input type="password" name="pas2" id="pas2" required>

        <br><br>

        <input type="submit" name="modificar" value="Modificar contraseña" class="btn btn-primary">
        <a href="../controlador/usuarioLista.php" class="btn btn-danger">Cancelar</a>
    </fieldset>
</form>
<?php
incluirTemplate("footer");
?>