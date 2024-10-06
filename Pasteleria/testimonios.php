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

<?php
    require('includes/funciones.php');
    incluirTemplate('header');
?>

    <title>Acerca de Nosotros -Pastelería Esencia </title>
   
         <link rel="stylesheet" href="build\css\stylesn.css"> 

         </section>
<section id="testimonio" class="bg-light py-5">
    <div class="container">        <h2 class="text-center mb-4">Testimonios</h2>
        <div class="row">            <!-- Testimonio 1 -->
            <div class="col-md-6 d-flex">                <div class="card mb-4 w-100 testimonial">
                    <img src="images/cliente/cliente4.jpeg" alt="Cliente 1" class="testimonial-image" contenteditable="true">                    <div class="card-body">
                        <p class="card-text" contenteditable="true">"¡La Pastelería Esencia es simplemente increíble!..."</p>                    </div>
                    <div class="card-footer text-muted" contenteditable="true">                        Ana Lopez
                    </div>                </div>
            </div>            <!-- Testimonio 2 -->
            <div class="col-md-6 d-flex">                <div class="card mb-4 w-100 testimonial">
                    <img src="images/cliente/cliente2.avif" alt="Cliente 2" class="testimonial-image" contenteditable="true">                    <div class="card-body">
                        <p class="card-text" contenteditable="true">"Desde que descubrí la Pastelería Esencia, se ha convertido en mi lugar favorito..."</p>                    </div>
                    <div class="card-footer text-muted" contenteditable="true">                        Carlos Jimenes
                    </div>                </div>
            </div>            <!-- Testimonio 3 -->
            <div class="col-md-6 d-flex">                <div class="card mb-4 w-100 testimonial">
                    <img src="images/cliente/cliente3.avif" alt="Cliente 3" class="testimonial-image" contenteditable="true">                    <div class="card-body">
                        <p class="card-text" contenteditable="true">"Los pasteles de chocolate de la Pastelería Esencia son los mejores..."</p>                    </div>
                    <div class="images/cliente4.avif" contenteditable="true">                        María Gonzales
                    </div>                </div>
            </div>            <!-- Testimonio 4 -->
            <div class="col-md-6 d-flex">                <div class="card mb-4 w-100 testimonial">
                    <img src="images/cliente/cliente1.jpeg" alt="Cliente 4" class="testimonial-image" contenteditable="true">                    <div class="card-body">
                        <p class="card-text" contenteditable="true">"Cada visita a la Pastelería Esencia es una experiencia única..."</p>                    </div>
                    <div class="card-footer text-muted" contenteditable="true">                        Pedro Martínez
                    </div>                </div>
            </div>        </div>
    </div></section>

<style>    /* ... tus estilos anteriores ... */
    /* Estilos adicionales para el efecto flotante y editabilidad de las imágenes */
    .testimonial {        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);    }
    .testimonial:hover {
        transform: translateY(-10px);        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .testimonial-image {    max-width: 80px; /* Cambia el 80px al tamaño que prefieras */
    height: auto; /* Esto mantendrá la relación de aspecto original de la imagen */    border-radius: 50%; /* Esto hará que la imagen sea circular, si así lo deseas */
    display: block; /* Esto asegurará que la imagen no esté en línea con el texto */    margin: 0 auto 20px; /* Centra la imagen y añade espacio debajo */
}
</style>

<?php
    incluirTemplate("footer");
?>

