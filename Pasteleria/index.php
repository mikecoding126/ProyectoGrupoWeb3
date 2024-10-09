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
    <title>Acerca de Nosotros -Pastelería Esencia </title>
   
         <link rel="stylesheet" href="build\css\stylesn.css">
         <link rel="stylesheet" href="build\css\app.css">
<?php
    require('includes/funciones.php');
    incluirTemplate('header');
?>

<section class="banner" class="container-fluid p-0">
    <div class="banner-img" style="position:relative; background:url('images/fondo1.jpg') center/cover no-repeat; height:400px;" onmousemove="parallax(event)">
        <div class="banner-text" style="position:absolute; top:50% ;left:50%; transform: translate(-50%,-50%);text-align:center; color:#fff;">
            <h1>LA PASTELERIA ESENCIA</h1>
            <p>Restaurante del mejor sabor y la mayor calidez con recetas que van de generación en generación</p>
            <a href="productos.php" class="btn  btn-primary">Ver menú</a>
        </div>
    </div>
</section>


<section id="Recomendacion" class="container mt-4">
        <h2 class="text-center">NUESTROS PRODUCTOS</h2>
        <br>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col d-flex">
                <div class="card h-100">
                <source srcset="img/Torta-Rosa.png" type="image/jpeg">
                    <img loading="lazy" src="img/Torta-Rosa.png" alt="producto">
                    <div class="card-body">
                        <h5 class="card-title">Torta Rosa Coffe Caramel 12 pers.</h5>
                        <p class="card-text small"><strong>Ingredientes: </strong>Masa de café, crema pastelera con espresso, Masa de chocolate , brigadeiro de vainilla con hilos de toffee salado, torta humectada con café latte.</p>
                        <p class="card-text"><strong>Precio: </strong>Bs.165.00</p>
                    </div>
                </div>
            </div>
            
            <div class="col d-flex">
                <div class="card h-100">
                <source srcset="img/Torta-Pasion.png" type="image/jpeg">
                    <img loading="lazy" src="img/Torta-Pasion.png" alt="producto">
                    <div class="card-body">
                        <h5 class="card-title">Torta Pasión 12 pers.</h5>
                        <p class="card-text small"><strong>Ingredientes: </strong>Torta con masa de vainilla y masa de chocolate con relleno de crema de chocolate y crema de frutilla.</p>
                        <p class="card-text"><strong>Precio: </strong>Bs.99.00</p>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card h-100">
                <source srcset="img/Torta-Oreo.png" type="image/jpeg">
                    <img loading="lazy" src="img/Torta-Oreo.png" alt="producto">
                    <div class="card-body">
                        <h5 class="card-title">Torta Oreo 12 pers.</h5>
                        <p class="card-text small"><strong>Ingredientes: </strong>¡Llegó abril y con él, la torta de tus sueños! 🎉🍰 Presentamos la increíble TORTA OREO: una masa de chocolate irresistible, rellena de la más suave crema de Oreo, capas de Oreos enteras, bañada en un delicado merengue italiano y un sedoso ganache de chocolate. Para rematar, ¡más Oreos decorando su corona! 😍🍫</p>
                        <p class="card-text"><strong>Precio: </strong>Bs.165.00</p>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card h-100">
                <source srcset="img/Rosa-Negra.jpg" type="image/jpeg">
                    <img loading="lazy" src="img/Rosa-Negra.jpg" alt="producto">
                    <div class="card-body">
                        <h5 class="card-title">Torta Rosa Negra 12 pers.</h5>
                        <p class="card-text small"><strong>Ingredientes: </strong>Esponjosa masa de chocolate, rellena con 3 capas de budín de chocolate, decorada con finos pétalos de chocolate que asemejan a una rosa. Para 12 personas.</p>
                        <p class="card-text"><strong>Precio: </strong>Bs.175.00</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center my-4">
            <a href="productos.php" class="btn btn-primary btn-lg">Ver más</a>
        </div>
    </section>
<section id="testimonio" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Testimonios</h2>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card mb-4 w-100">
                        <div class="card-body">
                            <p class="card-text">"¡La  Pastelería Esencia es simplemente increíble! Sus pasteles son una obra de arte tanto visual como gustativa. Cada bocado es una explosión de sabores deliciosos y frescos. Recientemente compré una tarta para el cumpleaños de mi hijo y fue un gran éxito. Todos los invitados quedaron impresionados por lo exquisito que estaba. ¡Definitivamente recomendaría esta pastelería a cualquiera que busque postres de alta calidad y servicio excepcional!"</p>
                        </div>
                        <div class="card-footer text-muted">
                            Ana Lopez
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex">
                    <div class="card mb-4 w-100">
                        <div class="card-body">
                            <p class="card-text">"Desde que descubrí la Pastelería Esencia, se ha convertido en mi lugar favorito para satisfacer mi antojo de dulces. Sus croissants son simplemente los mejores que he probado, con una textura increíblemente hojaldrada y un sabor inigualable. Además, sus macarons son una verdadera delicia, con una amplia variedad de sabores que siempre me hacen volver por más. El personal es amable y siempre dispuesto a recomendarte algo delicioso. ¡No puedo esperar para probar más de sus delicias en el futuro!"</p>
                        </div>
                        <div class="card-footer text-muted">
                            Carlos Jimenes
                        </div>
                    </div>
                </div>
                <div class="text-center my-4">
            <a href="testimonios.php" class="btn btn-primary btn-lg">Ver más</a>
        </div>
            </div>
        </div>
    </section>


    

  

<?php
    incluirTemplate("footer");
?>

