<?php
    session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }
    require '../../includes/config/database.php';
  
    $db = conectarDB();
    
    if(isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        
        $query = "UPDATE promociones SET estado = 'inactiva' WHERE id = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        
        if(mysqli_stmt_execute($stmt)) {
            header('Location: listado.php?mensaje=3');
        } else {
            header('Location: listado.php?error=1');
        }
        
        mysqli_stmt_close($stmt);
    }