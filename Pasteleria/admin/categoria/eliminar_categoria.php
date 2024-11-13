<?php
    session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }
 
 
require '../../includes/config/database.php';
$db = conectarDB();

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

if($id) {
    // Primero verificamos si la categoría está en uso
    $check_query = "SELECT COUNT(*) as total FROM productos WHERE categoria_id = $id";
    $check_result = mysqli_query($db, $check_query);
    $check_data = mysqli_fetch_assoc($check_result);

    if($check_data['total'] > 0) {
        echo "<script>
                alert('No se puede eliminar la categoría porque tiene productos asociados');
                window.location.href = 'listado_categorias.php';
              </script>";
    } else {
        $query = "DELETE FROM categorias WHERE id = $id";
        mysqli_query($db, $query);
    }
}

header('Location: listado_categorias.php');
?>