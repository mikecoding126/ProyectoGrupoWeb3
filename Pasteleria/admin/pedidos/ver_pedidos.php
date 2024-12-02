<?php

ob_start();
session_start();
$auth = $_SESSION['login'];
if (!$auth) {
    header("Location:/pasteleria");
}
    require '../../includes/config/database.php';
    $db = conectarDB();

    require '../../includes/funciones.php';
    incluirTemplate('Header');


// Procesar la actualización del estado si se recibe una solicitud
if (isset($_POST['actualizar_estado'])) {
    $idPedido = $_POST['id_pedido'];
    $nuevoEstado = 'enviado';
    $fechaEntrega = date('Y-m-d'); // Fecha actual
    
    $query = "UPDATE pedidos SET estado = ?, fecha_entrega = ? WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $nuevoEstado, $fechaEntrega, $idPedido);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: /ProyectoGrupoWeb3/Pasteleria/admin/pedidos/ver_pedidos.php");
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<!-- [Head section remains the same] -->

<body>
    <main class="contenedor seccion">
        <a href="../index.php" class="btn btn-primary mb-4">Volver</a>
        <h1 class="mb-4">Pedidos</h1>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID Pedido</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th>Fecha Pedido</th>
                        <th>Fecha Entrega</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlPedidos = "SELECT p.*, 
                                        c.telefono as cliente_telefono,
                                        u.nombre, 
                                        u.apellido,
                                        CONCAT(u.nombre, ' ', u.apellido) as nombre_completo
                                 FROM pedidos p 
                                 JOIN clientes c ON p.cliente_id = c.id 
                                 JOIN usuarios u ON c.usuario_id = u.id
                                 ORDER BY p.fecha_pedido DESC";
                    $resultPedidos = mysqli_query($db, $sqlPedidos);
                    
                    while ($pedido = mysqli_fetch_assoc($resultPedidos)) {
                        $fecha_pedido = date('d/m/Y H:i', strtotime($pedido['fecha_pedido']));
                        $fecha_entrega = $pedido['fecha_entrega'] ? date('d/m/Y', strtotime($pedido['fecha_entrega'])) : 'No establecida';
                    ?>
                        <tr>
                            <td><?php echo $pedido['id']; ?></td>
                            <td><?php echo htmlspecialchars($pedido['nombre_completo']); ?></td>
                            <td>
                                <span class="badge <?php 
                                    echo match($pedido['estado']) {
                                        'nuevo' => 'bg-primary',
                                        'espera' => 'bg-warning',
                                        'enviado' => 'bg-success',
                                        default => 'bg-secondary'
                                    };
                                ?>">
                                    <?php echo ucfirst($pedido['estado']); ?>
                                </span>
                            </td>
                            <td><?php echo $fecha_pedido; ?></td>
                            <td><?php echo $fecha_entrega; ?></td>
                            <td><?php echo htmlspecialchars($pedido['direccion_envio']); ?></td>
                            <td><?php echo htmlspecialchars($pedido['telefono']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($pedido['comentarios'])); ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    
                                    
                                    <?php if ($pedido['estado'] !== 'enviado') { ?>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="id_pedido" value="<?php echo $pedido['id']; ?>">
                                            <button type="submit" 
                                                    name="actualizar_estado" 
                                                    class="btn btn-success btn-sm" 
                                                    onclick="return confirm('¿Confirmar que el pedido ha sido enviado?')">
                                                <i class="fas fa-truck"></i>
                                            </button>
                                        </form>
                                    <?php } ?>
                                    
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php incluirTemplate('footer'); ?>
    
    
</body>
</html>