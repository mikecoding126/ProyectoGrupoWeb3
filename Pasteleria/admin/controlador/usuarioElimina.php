<?php
 
    // Verifica que el ID existe
    if(!isset($_GET['id'])) {
        echo "<script>
        alert('ID no especificado');
        location.href='../vista/usuarioLista.php';
        </script>";
        exit;
    }

    $cod = $_GET['id'];
    include("../modelo/usuario.php");
    $usu = new Usuario("", "", "", "", "", "");
    $r = $usu->eliminarUsuario($cod);
    
    if($r){
        echo "<script>
        alert('Se elimino');
        location.href='../vista/usuarioLista.php';
        </script>";
    }else{
        echo "<script>
        alert('No se elimino');
        location.href='../vista/usuarioLista.php';
        </script>";
    }
?>