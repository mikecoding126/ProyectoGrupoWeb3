<?php
     session_start();
     $auth = $_SESSION['login'];
     if(!$auth){
         header("Location:/pasteleria");
     }
    
    require "includes/config/database.php";
    $db = conectarDB();

    // Verificar que se recibió un ID
    if(!isset($_GET['cod'])) {
        echo "<script>
            alert('ID de proveedor no especificado');
            window.location.href='listado.php';
        </script>";
        exit;
    }

    // Sanitizar el ID recibido
    $id = filter_var($_GET['cod'], FILTER_VALIDATE_INT);

    if(!$id) {
        echo "<script>
            alert('ID no válido');
            window.location.href='listado.php';
        </script>";
        exit;
    }

    try {
        // Primero verificar si el proveedor existe
        $query = "SELECT * FROM proveedores WHERE id = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if(!$resultado->num_rows) {
            echo "<script>
                alert('Proveedor no encontrado');
                window.location.href='listado.php';
            </script>";
            exit;
        }

        // Realizar la eliminación
        $query = "DELETE FROM proveedores WHERE id = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if(mysqli_stmt_execute($stmt)) {
            echo "<script> 
                alert('Proveedor eliminado correctamente');
                window.location.href='listado.php';
            </script>";
        } else {
            throw new Exception("Error al eliminar");
        }

    } catch (Exception $e) {
        echo "<script> 
            alert('Error: No se pudo eliminar el proveedor');
            window.location.href='listado.php';
        </script>";
    }

    // Cerrar la conexión
    mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Proveedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="container mt-4">
        <div class="text-center">
            <h1>Eliminando Proveedor...</h1>
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Procesando...</span>
            </div>
        </div>
    </main>
</body>
</html>