<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <script src="https://kit.fontawesome.com/283335a286.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima+Madurai:wght@700&family=Mulish:wght@400;700&display=swap"
        rel="stylesheet">
    <title>Pastelería El Collita</title>
   
         <link rel="stylesheet" href="build\css\stylesn.css">
         <link rel="stylesheet" href="build\css\app.css">
<?php
    require('includes/funciones.php');
    incluirTemplate('header');
?>

<section class="banner container-fluid p-0">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height:400px;">
        <div class="carousel-inner" style="height:100%;">
            <div class="carousel-item active" style="height:100%; background:url('images/fondo.jpg') center/cover no-repeat;">
                <div class="banner-text" style="position:absolute; top:70%; left:50%; transform: translate(-50%,-50%); text-align:center; color:black;">
                    <h1>LA PASTELERIA Collita</h1>
                    <p>Restaurante del mejor sabor y la mayor calidez con recetas que van de generación en generación</p>
                    <a href="productos.php" class="btn btn-primary">Ver menú</a>
                </div>
            </div>
            <div class="carousel-item" style="height:100%; background:url('images/fondo2.jpg') center/cover no-repeat;">
                <div class="banner-text" style="position:absolute; top:70%; left:50%; transform: translate(-50%,-50%); text-align:center; color:black;">
                    <h1>LA PASTELERIA Collita</h1>
                    <p>Restaurante del mejor sabor y la mayor calidez con recetas que van de generación en generación</p>
                    <a href="productos.php" class="btn btn-primary">Ver menú</a>
                </div>
            </div>
            <div class="carousel-item" style="height:100%; background:url('images/fondo3.jpg') center/cover no-repeat;">
                <div class="banner-text" style="position:absolute; top:70%; left:50%; transform: translate(-50%,-50%); text-align:center; color:black;">
                    <h1>LA PASTELERIA Collita</h1>
                    <p>Restaurante del mejor sabor y la mayor calidez con recetas que van de generación en generación</p>
                    <a href="productos.php" class="btn btn-primary">Ver menú</a>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

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
   <div style="padding: 70px; padding-top: 10px; padding-bottom: 10px;">
        <h1 class="my-4">Los más vendidos</h1>
    </div>
    
    <div class="container text-center">
    <div class="row align-items-center">
        <?php

        $sql = "SELECT * FROM productos2 LIMIT 8";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nombre = $row['nombre'];
                $descripcion = $row['descripcion'];
                $imagen = $row['imagen'];
                echo '<div class="col-md-3">';
                echo '<div class="card m-2" style="width: 18rem;">';
                echo '<img src="'.$imagen.'" class="card-img-top" alt="'.$nombre.'">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$nombre.'</h5>';
                echo '<p class="card-text">'.$descripcion.'</p>';
                echo '<a href="productos.php?id='.$row['id'].'" class="btn btn-success">Ver más</a>';
                ?>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carritoModal">Carrito</button>
                <?php
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo 'No se encontraron productos.';
        }
        $result->free_result();
        ?>
    </div>
</div>


<?php
    incluirTemplate("footer");
?>

