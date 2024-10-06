<?php
    include("../vista/usuarioNuevo.php");
    if(isset($_POST['registrar'])){
        $e = $_POST['ema'];
        $p1 = $_POST['pas1'];
        $p2 = $_POST['pas2'];
        if(strcmp($p1,$p2)==0){
            include("../modelo/usuario.php");
            $pashash = password_hash($p1,PASSWORD_DEFAULT);
            $usu = new Usuario("","","");
            $r = $usu->registrarUsuarioAdmin($pashash,$e);
            if($r){
                echo "<script>
                    alert('Se registro Administrador');
                    location.href='../index.php'
                    </script>";
            }else{
                echo "<script>
                    alert('No se registro');
                    location.href = 'usuarioLista.php'
                </script>";
            }

        }
    }

?>