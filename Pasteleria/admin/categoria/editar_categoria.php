<?php
    session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }
   require '../../includes/funciones.php';
   
require '../../includes/config/database.php';
$db = conectarDB();

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
if(!$id) {
    header('Location: listado_categorias.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria = mysqli_real_escape_string($db, $_POST['categoria']);
    $estado = mysqli_real_escape_string($db, $_POST['estado']);

    $query = "UPDATE categorias SET 
              categoria = '$categoria',
              estado = '$estado'
              WHERE id = $id";
    
    if(mysqli_query($db, $query)) {
        header('Location: listado_categorias.php');
    }
}

$query = "SELECT * FROM categorias WHERE id = $id";
$resultado = mysqli_query($db, $query);
$categoria = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="container mt-4">
        <h1>Editar Categoría</h1>
        
        <form method="POST" class="w-50">
            <div class="mb-3">
                <label for="categoria" class="form-label">Nombre de la Categoría:</label>
                <input type="text" 
                       class="form-control" 
                       id="categoria" 
                       name="categoria" 
                       value="<?php echo $categoria['categoria']; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-select" id="estado" name="estado" required>
                    <option value="activo" <?php echo $categoria['estado'] === 'activo' ? 'selected' : ''; ?>>
                        Activo
                    </option>
                    <option value="inactivo" <?php echo $categoria['estado'] === 'inactivo' ? 'selected' : ''; ?>>
                        Inactivo
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="listado_categorias.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </main>
</body>
</html>