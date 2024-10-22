

<title>Promociones</title>


    <link rel="stylesheet" href="build/css/stylesn.css">
    <style>
        body {
            font-family: 'Mulish', sans-serif;
            background-color: #f5f5f5;
            color: #333;
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
            margin-bottom: 20px;
        }

        .anuncio:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            background-color: #f0f8ff;
        }

        .anuncio img {
            max-width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .precio {
            font-weight: bold;
            color: #ffc107;
            font-size: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            color: #007bff;
            margin-top: 10px;
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
    </style>
</head>

<?php
    require('includes/funciones.php');
    incluirTemplate('header');
?>

<body>

    <section class="seccion contenedor mt-5">
        <h2 class="text-center mb-5">PROMOCIONES</h2>

<h3 style="text-align: center;">
<?php
    date_default_timezone_set('America/La_Paz');
    $fecha_actual = date("d-m-Y H:i:s");
    echo $fecha_actual;
?>
</h3>
        <div class="row">
        <?php
        require 'includes/config/database.php';
        $db = conectarDB();

        $con_sql = "SELECT * FROM promociones WHERE estado = 'Disponible'";
        $res = mysqli_query($db, $con_sql);
        if ($res) {
            while ($reg = mysqli_fetch_assoc($res)) {
                ?>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 anuncio">
                        <img src="admin/promociones/imagenes/<?php echo $reg['imagen']; ?>" class="card-img-top" alt="<?php echo $reg['nombre']; ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $reg['nombre']; ?></h5>
                            <p class="card-text"><?php echo $reg['descripcion']; ?></p>
                            <p class="precio card-text">Bs.-<?php echo $reg['precio']; ?></p>
                        </div>
                    </div>
                </div>

            <?php
            }
            mysqli_free_result($res);
        } else {
            echo "Error en la consulta: " . mysqli_error($db);
        }
        ?>
    </div>
    <?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "pasteleria"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>
    <div class="container my-5">
    <h1>MAS PRODUCTOS POR CATEGORIA</h1>
<div class="col-lg-3">
    
</div>
    </section>
    <div class="row">
    <div class="col-lg-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Filtrar por categoría</h5>
            <ul class="list-group">
                <li class="list-group-item"><a href="promociones.php">Todos los productos</a></li>
                <li class="list-group-item"><a href="promociones.php?categoria=Pasteles">Pasteles</a></li>
                <li class="list-group-item"><a href="promociones.php?categoria=Galletas">Galletas</a></li>
                <li class="list-group-item"><a href="promociones.php?categoria=Panes%20dulces">Panes dulces</a></li>
                <li class="list-group-item"><a href="promociones.php?categoria=Cupcakes">Cupcakes</a></li>
            </ul>
        </div>
    </div>
</div>   
    <div class="col-lg-9">
        <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Buscar productos" id="searchInput">
        <button class="btn btn-outline-secondary" type="button" id="searchButton">Buscar</button>
    </div>
    <script>
        const searchInput = document.getElementById("searchInput");
        const searchButton = document.getElementById("searchButton");
        searchInput.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                searchButton.click();
            }
        });
    </script>
            <div id="productList">
                <div class="row">
                    <?php
                    
                    $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';
                    $category = isset($_GET['categoria']) ? $_GET['categoria'] : '';
                    $sql = "SELECT * FROM productos2";
                    if (!empty($category)) {
                        if ($category === "Panes dulces") {
                            $sql .= " WHERE categoria = 'Panes dulces'";
                        } else {
                            $sql .= " WHERE categoria = '$category'";
                        }
                    }
                    if (!empty($searchQuery)) {
                        if (empty($category)) {
                            $sql .= " WHERE nombre LIKE '%$searchQuery%'";
                        } else {
                            $sql .= " AND nombre LIKE '%$searchQuery%'";
                        }
                    }
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $nombre = $row['nombre'];
                            $descripcion = $row['descripcion'];
                            $imagen = $row['imagen'];
                            $precio = $row['precio'];
                            echo '<div class="col-lg-4 mb-4">';
                            echo '<div class="card h-100">';
                            echo '<a href="promociones.php?id='.$row['id'].'" class="text-decoration-none">';
                            echo '<img src="'.$imagen.'" class="card-img-top img-fluid" alt="'.$nombre.'" style="max-height: 200px; object-fit: contain;">';
                            echo '</a>';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">'.$nombre.'</h5>';
                            echo '<p class="card-text">'.$descripcion.'</p>';
                            echo '<p class="card-text">Precio: $'.$precio.'</p>';
                            ?>
                            <form action="agregar_al_carro.php" method="POST">
                                <input type="hidden" name="idProducto" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
                                <input type="hidden" name="precio" value="<?php echo $precio; ?>">
                                <input type="hidden" name="cantidad" value="1"> <!-- Por defecto, agregamos 1 producto al carrito -->
                                <input type="hidden" name="imagen" value="<?php echo $imagen; ?>">
                                <button class="btn btn-success" onclick="agregarAlCarrito(event, <?php echo $row['id']; ?>, '<?php echo $nombre; ?>', <?php echo $precio; ?>)">Agregar al carrito</button>
                            </form>
                            <?php
                            echo '<a href="producto.php?id='.$row['id'].'" class="btn btn-success">Ver más</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo 'No se encontraron productos.';
                    }
                    $result->free_result();
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script src="build/js/bundle.min.js"></script>
</body>

<?php
    incluirTemplate("footer");
?>

</html>
