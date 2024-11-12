<?php
    /*session_start();
    $auth = $_SESSION['login'];
    if (!$auth) {
        header("Location:/pasteleria");
    }*/
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Verificar que existe el ID
    if(!isset($_GET['cod'])) {
        echo "<script>
            alert('ID de proveedor no especificado');
            window.location.href='listado.php';
        </script>";
        exit;
    }

    $cod = filter_var($_GET['cod'], FILTER_VALIDATE_INT);

    // Procesar el formulario cuando se envía
    if(isset($_POST['Modificar'])){
        $nombre = mysqli_real_escape_string($db, $_POST['nom']);
        $telefono = mysqli_real_escape_string($db, $_POST['tel']);
        $correo = mysqli_real_escape_string($db, $_POST['corr']);
        $direccion = mysqli_real_escape_string($db, $_POST['dir']);
        $estado = mysqli_real_escape_string($db, $_POST['estado']);

        // Usar consulta preparada para la actualización
        $query = "UPDATE proveedores SET 
                 nombre = ?, 
                 telefono = ?, 
                 correo = ?, 
                 direccion = ?,
                 estado = ? 
                 WHERE id = ?";
        
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "sssssi", $nombre, $telefono, $correo, $direccion, $estado, $cod);
        
        if(mysqli_stmt_execute($stmt)) {
            echo "<script>
                alert('Proveedor actualizado correctamente');
                window.location.href='listado.php';
            </script>";
        } else {
            echo "<script>
                alert('Error al actualizar el proveedor');
            </script>";
        }
    }

    // Obtener datos actuales del proveedor
    $query = "SELECT * FROM proveedores WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "i", $cod);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $proveedor = mysqli_fetch_assoc($resultado);

    if(!$proveedor) {
        echo "<script>
            alert('Proveedor no encontrado');
            window.location.href='listado.php';
        </script>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Proveedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Modificar Proveedor</h1>
        <a href="listado.php" class="btn btn-secondary mb-3">Volver</a>

        <form method="POST" class="needs-validation" novalidate>
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nombre</label>
                        <input type="text" 
                               class="form-control" 
                               name="nom" 
                               id="nom" 
                               value="<?php echo htmlspecialchars($proveedor['nombre']); ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="tel" class="form-label">Teléfono</label>
                        <input type="tel" 
                               class="form-control" 
                               name="tel" 
                               id="tel" 
                               value="<?php echo htmlspecialchars($proveedor['telefono']); ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="corr" class="form-label">Correo</label>
                        <input type="email" 
                               class="form-control" 
                               name="corr" 
                               id="corr" 
                               value="<?php echo htmlspecialchars($proveedor['correo']); ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="dir" class="form-label">Dirección</label>
                        <input type="text" 
                               class="form-control" 
                               name="dir" 
                               id="dir" 
                               value="<?php echo htmlspecialchars($proveedor['direccion']); ?>" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estado del Proveedor</label>
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="estado" 
                                   value="promocionado" 
                                   <?php echo $proveedor['estado'] === 'promocionado' ? 'checked' : ''; ?>>
                            <label class="form-check-label">Promocionado</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="radio" 
                                   name="estado" 
                                   value="no_promocionado" 
                                   <?php echo $proveedor['estado'] === 'no_promocionado' ? 'checked' : ''; ?>>
                            <label class="form-check-label">No Promocionado</label>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" 
                                name="Modificar" 
                                class="btn btn-primary">
                            Actualizar Proveedor
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validación del formulario
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>