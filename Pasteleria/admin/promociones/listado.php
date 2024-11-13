<?php
    session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria");
    }


require '../../includes/config/database.php';
$db = conectarDB();
require '../../includes/funciones.php';
incluirTemplate('header');
// Consulta JOIN para obtener también el nombre del producto
$query = "SELECT p.*, pr.nombre as nombre_producto 
          FROM promociones p 
          LEFT JOIN productos pr ON p.producto_id = pr.id 
          WHERE p.estado = 'activa' 
          ORDER BY p.fecha_inicio DESC";
$resultado = mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de Promociones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table img {
            max-width: 100px;
            height: auto;
        }
        .badge {
            font-size: 0.9em;
        }
        .precio-original {
            text-decoration: line-through;
            color: #999;
        }
    </style>
</head>
<body>

<main class="container mt-4">
    <h1>Listado de Promociones</h1>
    <a href="../index.php" class="btn btn-primary">Volver</a>
    <a href="crear.php" class="btn btn-success mb-3">Nueva Promoción</a>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre Promoción</th>
                    <th>Producto</th>
                    <th>Precios</th>
                    <th>Descuento</th>
                    <th>Vigencia</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($promocion = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo $promocion['id']; ?></td>
                    <td>
                        <?php if($promocion['imagen']): ?>
                            <img src="imagenes/<?php echo $promocion['imagen']; ?>" 
                                 alt="<?php echo $promocion['nombre']; ?>" 
                                 class="img-thumbnail">
                        <?php else: ?>
                            <span class="text-muted">Sin imagen</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <strong><?php echo $promocion['nombre']; ?></strong>
                        <br>
                        <small class="text-muted"><?php echo $promocion['descripcion']; ?></small>
                    </td>
                    <td><?php echo $promocion['nombre_producto']; ?></td>
                    <td>
                        <?php if($promocion['monto_descuento'] > 0 || $promocion['porcentaje_descuento'] > 0): ?>
                            <span class="precio-original">BS.<?php echo number_format($promocion['precio'], 2); ?></span>
                            <br>
                            <strong class="text-success">
                                BS.<?php 
                                    $precio_final = $promocion['precio'];
                                    if($promocion['monto_descuento'] > 0) {
                                        $precio_final -= $promocion['monto_descuento'];
                                    } elseif($promocion['porcentaje_descuento'] > 0) {
                                        $precio_final -= ($precio_final * ($promocion['porcentaje_descuento']/100));
                                    }
                                    echo number_format($precio_final, 2);
                                ?>
                            </strong>
                        <?php else: ?>
                            $<?php echo number_format($promocion['precio'], 2); ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($promocion['porcentaje_descuento'] > 0): ?>
                            <span class="badge bg-info"><?php echo $promocion['porcentaje_descuento']; ?>%</span>
                        <?php endif; ?>
                        <?php if($promocion['monto_descuento'] > 0): ?>
                            <span class="badge bg-warning">-Bs<?php echo number_format($promocion['monto_descuento'], 2); ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <small>
                            Inicio: <?php echo date('d/m/Y', strtotime($promocion['fecha_inicio'])); ?><br>
                            Fin: <?php echo date('d/m/Y', strtotime($promocion['fecha_fin'])); ?>
                        </small>
                    </td>
                    <td>
                        <?php if($promocion['estado'] == 'activa'): ?>
                            <span class="badge bg-success">Activa</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Inactiva</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="btn-group-vertical">
                            <a href="actualizar.php?id=<?php echo $promocion['id']; ?>" 
                               class="btn btn-primary btn-sm mb-1">Editar</a>
                            <a href="borrar.php?id=<?php echo $promocion['id']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('¿Desea desactivar esta promoción?')">
                                Desactivar
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>