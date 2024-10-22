<?php
    require('includes/funciones.php');
    incluirTemplate('header');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Pateleria El Collita </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="search.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container my-5">
<div class="col-lg-3">
    <h1>Todos los Productos </h1>
</div>
<div class="row">
    <div class="col-lg-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Filtrar por categoría</h5>
            <ul class="list-group">
                <li class="list-group-item"><a href="productos.php">Todos los productos</a></li>
                <li class="list-group-item"><a href="productos.php?categoria=Pasteles">Pasteles</a></li>
                <li class="list-group-item"><a href="productos.php?categoria=Galletas">Galletas</a></li>
                <li class="list-group-item"><a href="productos.php?categoria=Panes%20dulces">Panes dulces</a></li>
                <li class="list-group-item"><a href="productos.php?categoria=Cupcakes">Cupcakes</a></li>
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
                    include 'conexion.php';
                    $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';
                    $category = isset($_GET['categoria']) ? $_GET['categoria'] : '';
                    $sql = "SELECT * FROM productos";
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
                            echo '<a href="producto.php?id='.$row['id'].'" class="text-decoration-none">';
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
function agregarAlCarrito(event, idProducto, nombreProducto, precioProducto) {
    event.preventDefault();
    const formData = new FormData();
    formData.append('id', idProducto);
    formData.append('nombre', nombreProducto);
    formData.append('precio', precioProducto);
    fetch('agregar_al_carro.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            $('#carritoModalBody').load('carrito.php #carritoContent');
            $('#carritoModal').modal('show');
        } else {
            console.error('Error al agregar el producto al carrito:', response.statusText);
        }
    })
    .catch(error => {
        console.error('Error al agregar el producto al carrito:', error);
    });
}
</script>
</body>
</html>