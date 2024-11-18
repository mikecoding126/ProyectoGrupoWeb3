<?php
session_start();
require_once('includes/config/database.php');
$db = conectarDB();

if (!isset($_SESSION['usuario_id']) || !isset($_GET['id'])) {
    exit('Acceso no autorizado');
}

$pedido_id = $_GET['id'];

// Verificar que el pedido pertenece al usuario
$query = "SELECT p.* 
          FROM pedidos p
          JOIN clientes c ON p.cliente_id = c.id
          WHERE p.id = ? AND c.usuario_id = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "ii", $pedido_id, $_SESSION['usuario_id']);
mysqli_stmt_execute($stmt);
$pedido = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$pedido) {
    exit('Pedido no encontrado');
}

// Obtener los detalles del pedido
$query = "SELECT dp.*, p.nombre as producto_nombre, p.imagen
          FROM detalles_pedidos dp
          JOIN productos p ON dp.producto_id = p.id
          WHERE dp.pedido_id = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "i", $pedido_id);
mysqli_stmt_execute($stmt);
$detalles = mysqli_stmt_get_result($stmt);
?>

<style>
    .detalles-pedido {
        background: #fff;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .detalles-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
        margin-bottom: 20px;
    }

    .detalles-titulo {
        font-size: 1.5em;
        color: #333;
        margin: 0;
    }

    .detalles-fecha {
        color: #666;
        font-size: 0.9em;
    }

    .productos-tabla {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .productos-tabla th {
        background: #f8f9fa;
        padding: 12px;
        text-align: left;
        color: #333;
        font-weight: 600;
    }

    .productos-tabla td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    .producto-imagen {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }

    .producto-nombre {
        color: #333;
        font-weight: 500;
    }

    .total-pedido {
        text-align: right;
        padding-top: 15px;
        border-top: 2px solid #f0f0f0;
    }

    .total-pedido .total {
        font-size: 1.2em;
        font-weight: 600;
        color: #333;
    }

    .estado-pedido {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: 500;
    }

    .estado-nuevo { background: #e3f2fd; color: #1976d2; }
    .estado-espera { background: #fff3e0; color: #f57c00; }
    .estado-enviado { background: #e8f5e9; color: #388e3c; }

    @media (max-width: 768px) {
        .productos-tabla {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<div class="detalles-pedido">
    <div class="detalles-header">
        <div>
            <h3 class="detalles-titulo">Pedido #<?php echo $pedido_id; ?></h3>
            <span class="detalles-fecha">
                <?php echo date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])); ?>
            </span>
        </div>
        <span class="estado-pedido estado-<?php echo $pedido['estado']; ?>">
            <?php 
            switch($pedido['estado']) {
                case 'nuevo': echo 'Nuevo'; break;
                case 'espera': echo 'En Espera'; break;
                case 'enviado': echo 'Enviado'; break;
                default: echo 'En Proceso'; break;
            }
            ?>
        </span>
    </div>

    <table class="productos-tabla">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total = 0;
            while ($detalle = mysqli_fetch_assoc($detalles)): 
                $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
                $total += $subtotal;
            ?>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <?php if (!empty($detalle['imagen'])): ?>
                                <img src="admin/productos/imagenes/<?php echo htmlspecialchars($detalle['imagen']); ?>" 
                                     alt="<?php echo htmlspecialchars($detalle['producto_nombre']); ?>"
                                     class="producto-imagen">
                            <?php endif; ?>
                            <span class="producto-nombre">
                                <?php echo htmlspecialchars($detalle['producto_nombre']); ?>
                            </span>
                        </div>
                    </td>
                    <td>Bs.<?php echo number_format($detalle['precio_unitario'], 2); ?></td>
                    <td><?php echo $detalle['cantidad']; ?></td>
                    <td>Bs.<?php echo number_format($subtotal, 2); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="total-pedido">
        <span class="total">Total: Bs.<?php echo number_format($total, 2); ?></span>
    </div>
</div>