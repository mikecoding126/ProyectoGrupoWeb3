 <title>Productos</title>
    <link rel="stylesheet" href="build/css/stylesn.css">
    <style>
        body {
            font-family: 'Mulish', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .contenedor-anuncios {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .anuncio {
            border: 1px solid #ccc;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-color: #ffffff;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .anuncio:hover {
            transform: scale(1.1);
            z-index: 1;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            background-color: #f0f8ff; 
        }

        .anuncio img {
            border-radius: 10px;
        }

        .precio {
            font-weight: bold;
            color: #ffc107; 
            font-size: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem; 
            color: #007bff;
        }

        .card-text {
            color: #555;
        }

        .seccion {
            padding: 50px 0;
        }

        h2 {
            font-family: 'Arima Madurai', cursive;
            font-size: 2.5rem;
            color: #6c757d;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .text-end a {
            color: #fff;
        }
        * Estilos adicionales para el menú de categorías */
.btn-group {
    flex-wrap: wrap;
    justify-content: center;
    gap: 5px;
    margin-bottom: 20px;
}

.btn-outline-primary {
    margin: 5px;
}

.btn-outline-primary.active {
    background-color: #007bff;
    color: white;
}

/* Ajustes responsive */
@media (max-width: 768px) {
    .btn-group {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }
    
    .btn-outline-primary {
        margin: 2px;
    }
}
    </style>
</head>

<?php
    require('includes/funciones.php');
    incluirTemplate('header');
?>

<body>

<section class="seccion contenedor mt-5">
    <h2 class="text-center mb-5">PRODUCTOS</h2>

    <!-- Menú de categorías -->
    <div class="text-center mb-4">
        <div class="btn-group" role="group">
            <a href="?categoria=todos" class="btn btn-outline-primary <?php echo (!isset($_GET['categoria']) || $_GET['categoria'] == 'todos') ? 'active' : ''; ?>">Todos</a>
            <a href="?categoria=Pasteles" class="btn btn-outline-primary <?php echo (isset($_GET['categoria']) && $_GET['categoria'] == 'Pasteles') ? 'active' : ''; ?>">Pasteles</a>
            <a href="?categoria=Tartas" class="btn btn-outline-primary <?php echo (isset($_GET['categoria']) && $_GET['categoria'] == 'Tartas') ? 'active' : ''; ?>">Tartas</a>
            <a href="?categoria=Packs" class="btn btn-outline-primary <?php echo (isset($_GET['categoria']) && $_GET['categoria'] == 'Packs') ? 'active' : ''; ?>">Packs</a>
            <a href="?categoria=Aperitivos" class="btn btn-outline-primary <?php echo (isset($_GET['categoria']) && $_GET['categoria'] == 'Aperitivos') ? 'active' : ''; ?>">Aperitivos</a>
            <a href="?categoria=Brownies" class="btn btn-outline-primary <?php echo (isset($_GET['categoria']) && $_GET['categoria'] == 'Brownies') ? 'active' : ''; ?>">Brownies</a>
            <a href="?categoria=Cheesecakes" class="btn btn-outline-primary <?php echo (isset($_GET['categoria']) && $_GET['categoria'] == 'Cheesecakes') ? 'active' : ''; ?>">Cheesecakes</a>
            <a href="?categoria=Galletas" class="btn btn-outline-primary <?php echo (isset($_GET['categoria']) && $_GET['categoria'] == 'Galletas') ? 'active' : ''; ?>">Galletas</a>
        </div>
    </div>

    <div class="row">
        <?php
        require 'includes/config/database.php';
        $db = conectarDB();
        
        // Construir la consulta SQL según la categoría seleccionada
        $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'todos';
        if ($categoria == 'todos') {
            $con_sql = "SELECT * FROM productos WHERE estado = 'Disponible'";
        } else {
            $categoria = mysqli_real_escape_string($db, $categoria); // Prevenir SQL injection
            $con_sql = "SELECT * FROM productos WHERE estado = 'Disponible' AND categoria = '$categoria'";
        }

        $res = mysqli_query($db, $con_sql);
        while ($reg = mysqli_fetch_assoc($res)) {
        ?>

        <div class="col-md-4 mb-4">
            <div class="card h-100 anuncio">
                <img src="admin/productos/imagenes/<?php echo $reg['imagen']; ?>" class="card-img-top" alt="<?php echo $reg['nombre']; ?>">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $reg['nombre']; ?></h5>
                    <p class="card-text"><?php echo $reg['descripcion']; ?></p>
                    <p class="precio card-text">Bs.-<?php echo $reg['precio']; ?></p>
                    <!-- Formulario para agregar al carrito -->
                    <form action="admin/includes/carrito.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $reg['codigo_producto']; ?>">
                        <input type="hidden" name="nombre" value="<?php echo $reg['nombre']; ?>">
                        <input type="hidden" name="precio" value="<?php echo $reg['precio']; ?>">
                        <input type="hidden" name="action" value="agregar">
                        <button type="submit" class="btn btn-success">Agregar al carrito</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
        }
        
        // Verificar si no hay productos en la categoría
        if (mysqli_num_rows($res) == 0) {
            echo '<div class="col-12 text-center">';
            echo '<p class="alert alert-info">No hay productos disponibles en esta categoría.</p>';
            echo '</div>';
        }
        ?>
    </div>
</section>


        <div class="text-end mt-4">
            <a href="productos.php" class="btn btn-success">Ver Todas</a>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script src="build/js/bundle.min.js"></script>
</body>
<?php
    incluirTemplate("footer");
?>
</html>
