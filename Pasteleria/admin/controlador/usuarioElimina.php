<?php
    $cod = $_GET['cod'];
    include("../modelo/usuario.php");
    $usu = new Usuario("","","");
    $r = $usu -> eliUsuario($cod);
    if($r){
        echo "<script>
        alert('Se elimino');
        location.href='usuarioLista.php';
        </script>";
    }else{
        echo "<script>
        alert('No se elimino')
        </script>";
    }
?>