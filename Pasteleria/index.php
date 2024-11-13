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

<style>
    .hero-banner {
        position: relative;
        height: 600px;
        overflow: hidden;
    }

    .carousel-item {
        height: 600px;
        position: relative;
    }

    .carousel-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.4));
    }

    .banner-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 80%;
        max-width: 800px;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        backdrop-filter: blur(8px);
        transition: all 0.3s ease;
    }

    .banner-text h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .banner-text p {
        font-size: 1.2rem;
        color: #34495e;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .btn-menu {
        padding: 0.8rem 2rem;
        font-size: 1.1rem;
        background: #e74c3c;
        color: white;
        border: none;
        border-radius: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .btn-menu:hover {
        background: #c0392b;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
        opacity: 0.7;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1;
    }

    @media (max-width: 768px) {
        .hero-banner {
            height: 500px;
        }

        .carousel-item {
            height: 500px;
        }

        .banner-text {
            width: 70%;
            padding: 1.2rem;
        }

        .banner-text h1 {
            font-size: 2rem;
        }

        .banner-text p {
            font-size: 1rem;
        }

        .btn-menu {
            padding: 0.6rem 1.5rem;
            font-size: 1rem;
        }
    }
</style>

<section class="hero-banner">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="background: url('images/fondo.jpg') center/cover no-repeat;">
                <div class="banner-text">
                    <h1>La Pastelería "El Collita"</h1>
                    <p>Descubre el arte de la repostería tradicional con recetas que han pasado de generación en generación, 
                       creando momentos dulces inolvidables has tu pedido con un solo clic </p>
                    <a href="productos.php" class="btn btn-menu">Explorar Productos</a>
                </div>
            </div>
            <div class="carousel-item" style="background: url('images/fondo2.jpg') center/cover no-repeat;">
                <div class="banner-text">
                    <h1>Sabores Artesanales</h1>
                    <p>Cada postre es una obra maestra elaborada con los ingredientes más frescos y el cariño de siempre.</p>
                    <a href="productos.php" class="btn btn-menu">Ver Creaciones</a>
                </div>
            </div>
            <div class="carousel-item" style="background: url('images/fondo3.jpg') center/cover no-repeat;">
                <div class="banner-text">
                    <h1>Dulces Momentos</h1>
                    <p>Hacemos de cada celebración un momento especial con nuestros pasteles y postres artesanales.</p>
                    <a href="productos.php" class="btn btn-menu">Hacer Pedido</a>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
</section>

<?php

require 'includes/config/database.php';
$db = conectarDB();
?>
   <div style="padding: 70px; padding-top: 10px; padding-bottom: 10px;">
        <h1 class="my-4">Los más populares</h1>
    </div>
    
    <div class="container text-center">
    <div class="row align-items-center">
    <?php
$sql = "SELECT * FROM productos LIMIT 8";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
        $imagen = 'admin/productos/imagenes/' . $row['imagen'];
        echo '<div class="col-md-3">';
        echo '<div class="card m-2" style="width: 18rem;">';
        echo '<img src="'.$imagen.'" class="card-img-top" alt="'.$nombre.'">';
        
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$nombre.'</h5>';
        echo '<p class="card-text">'.$descripcion.'</p>';
        echo '<p class="card-text" style="color: red; font-size: larger;">Bs. ' . $precio . '</p>';
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

