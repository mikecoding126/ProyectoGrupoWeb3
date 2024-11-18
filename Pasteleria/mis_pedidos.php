<?php
session_start();
require_once('includes/config/database.php');
$db = conectarDB();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

// Obtener el ID del cliente
$query = "SELECT id FROM clientes WHERE usuario_id = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['usuario_id']);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$cliente = mysqli_fetch_assoc($resultado);

// Obtener los pedidos del cliente
$query = "SELECT p.*, 
          COUNT(dp.id) as total_productos,
          SUM(dp.cantidad * dp.precio_unitario) as total_pedido
          FROM pedidos p
          LEFT JOIN detalles_pedidos dp ON p.id = dp.pedido_id
          WHERE p.cliente_id = ?
          GROUP BY p.id
          ORDER BY p.fecha_pedido DESC";

$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "i", $cliente['id']);
mysqli_stmt_execute($stmt);
$pedidos = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
    <link rel="stylesheet" href="build/css/stylesn.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dashboard {
            padding: 2rem;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .dashboard-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .dashboard-title {
            font-size: 2.5rem;
            margin: 0;
            font-weight: 700;
        }

        .dashboard-subtitle {
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        .pedidos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .pedido-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .pedido-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .pedido-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .pedido-numero {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .pedido-fecha {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        .pedido-estado {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .estado-nuevo {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .estado-espera {
            background-color: #fff3e0;
            color: #f57c00;
        }

        .estado-enviado {
            background-color: #e8f5e9;
            color: #388e3c;
        }

        .pedido-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin: 1rem 0;
        }

        .info-item {
            text-align: center;
            padding: 0.75rem;
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .info-label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .btn-detalles {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-detalles:hover {
            opacity: 0.9;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            position: relative;
            background-color: #fff;
            margin: 5% auto;
            padding: 2rem;
            width: 90%;
            max-width: 700px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            animation: slideIn 0.3s ease;
        }

        .close {
            position: absolute;
            right: 1.5rem;
            top: 1rem;
            font-size: 1.5rem;
            color: #666;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: #333;
        }

        .detalles-tabla {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }

        .detalles-tabla th,
        .detalles-tabla td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .detalles-tabla th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }

        .detalles-tabla tr:last-child td {
            border-bottom: none;
        }

        .no-pedidos {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .no-pedidos h3 {
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .no-pedidos p {
            color: #7f8c8d;
            margin-bottom: 1.5rem;
        }

        .no-pedidos .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: opacity 0.3s ease;
        }

        .no-pedidos .btn:hover {
            opacity: 0.9;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .dashboard {
                padding: 1rem;
            }

            .pedidos-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                margin: 10% auto;
                width: 95%;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <?php require_once('includes/template/header.php'); ?>
    
    <div class="dashboard">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Mis Pedidos</h1>
            <p class="dashboard-subtitle">Gestiona y revisa todos tus pedidos</p>
        </div>

        <?php if (mysqli_num_rows($pedidos) > 0): ?>
            <div class="pedidos-grid">
                <?php while ($pedido = mysqli_fetch_assoc($pedidos)): ?>
                    <div class="pedido-card">
                        <div class="pedido-header">
                            <div>
                                <div class="pedido-numero">
                                    <i class="fas fa-shopping-bag"></i>
                                    Pedido #<?php echo $pedido['id']; ?>
                                </div>
                                <div class="pedido-fecha">
                                    <i class="far fa-calendar-alt"></i>
                                    <?php echo date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])); ?>
                                </div>
                            </div>
                            <span class="pedido-estado estado-<?php echo $pedido['estado']; ?>">
                                <?php 
                                switch($pedido['estado']) {
                                    case 'nuevo': echo '<i class="fas fa-star"></i> Nuevo'; break;
                                    case 'espera': echo '<i class="fas fa-clock"></i> En Espera'; break;
                                    case 'enviado': echo '<i class="fas fa-truck"></i> Enviado'; break;
                                }
                                ?>
                            </span>
                        </div>

                        <div class="pedido-info">
                            <div class="info-item">
                                <div class="info-label">Productos</div>
                                <div class="info-value">
                                    <i class="fas fa-box"></i>
                                    <?php echo $pedido['total_productos']; ?>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Total</div>
                                <div class="info-value">
                                    <i class="fas fa-dollar-sign"></i>
                                    Bs.<?php echo number_format($pedido['total_pedido'], 2); ?>
                                </div>
                            </div>
                        </div>

                        <button class="btn-detalles" onclick="verDetalles(<?php echo $pedido['id']; ?>)">
                            <i class="fas fa-eye"></i>
                            Ver Detalles
                        </button>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="no-pedidos">
                <i class="fas fa-shopping-cart fa-3x" style="color: #6c757d; margin-bottom: 1rem;"></i>
                <h3>No tienes pedidos realizados</h3>
                <p>¡Explora nuestros productos y realiza tu primer pedido!</p>
                <a href="productos.php" class="btn">
                    <i class="fas fa-store"></i>
                    Ver Productos
                </a>
            </div>
        <?php endif; ?>

        <!-- Modal para detalles del pedido -->
        <div id="detallesModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3>Detalles del Pedido</h3>
                <div id="detallesPedidoContenido"></div>
            </div>
        </div>
    </div>

    <?php require_once('includes/template/footer.php'); ?>

    <script>
        const modal = document.getElementById('detallesModal');
        const span = document.getElementsByClassName('close')[0];

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function verDetalles(pedidoId) {
            fetch(`obtener_detalles_pedido.php?id=${pedidoId}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('detallesPedidoContenido').innerHTML = data;
                    modal.style.display = "block";
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>