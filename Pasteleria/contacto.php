
<!doctype html>
<html lang="en">
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
        <link rel="stylesheet" href="build\css\estilos.css">    
        <link rel="stylesheet" href="build\css\stylesn.css"> 

</head>

<body>
    <?php
      require('includes/funciones.php');
      incluirTemplate('header');
      require 'includes/config/database.php';
      $db=conectarDB(); 
    ?>
        <section id="id" class="container mt-4 text-center">
                <div class="p-3 mb-2 bg-light text-dark background-image">
                        <h1>Contactanos</h1>
                        <h2>Estamos para ayudarte.</h2>
                </div>
        </section>
    <main >
       
   <div class="formulario-contacto container">

        <div class="informacion-contacto background-image">
            <h3>Contactanos</h3>
            <p><i class="fas fa-map-marker-alt"></i>23. calle falsa 75012</p>
            <p><i class="fas fa-envelope"></i> luca@turilli.it</p>
            <p><i class="fas fa-phone-alt"></i>+591 66554433</p>
            <div class="redes-sociales">
                <i class="fab fa-facebook-square"></i>
                <i class="fab fa-twitter-square"></i>
                <i class="fab fa-instagram"></i>
            </div>
        </div>

        <form action="admin/contacto/contactoRegistro.php" method="post" class="formulario" enctype="multipart/form-data">
            <div class="input-formulario">
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Pedro"  name="nom" id="nom">
            </div>
            <div class="input-formulario">
                <label for="apellidos">Apellido</label>
                <input type="text" placeholder="Perez" name="ape" id="ape">
            </div>
            <div class="input-formulario">
                <label for="correo">Correo</label>
                <input type="email" placeholder="ejemplo@ejemplo.com"  name="cor" id="cor">
            </div>
            <div class="input-formulario">
                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="+591 66554433"  name="tel" id="tel">
            </div>
            <div class="input-formulario">
                <label for="mensaje">Mensaje</label>
                <textarea type="text" name="men" id="men" cols="30" rows="10"></textarea>
            </div>
            <div class="input-formulario">
                <input type="submit" class="btn btn-success" value="Enviar">
            </div>
            
        </form>
    </div>
  <div>
    <section class="mapa container">
        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2791.6295124010317!2d-68.12406201536243!3d-16.50024320576616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915f2068e16b8477%3A0xf172d2189f8ef8ee!2sC.%20Hugo%20Estrada%2C%20La%20Paz!5e0!3m2!1ses-419!2sbo!4v1702003114499!5m2!1ses-419!2sbo" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
    </section>
  </div>
  <div class="preguntas-frecuentes container"> 
                <h1 class="container mt-4 text-center">Preguntas Frecuentes</h1>
            <div class="row row-cols-1 row-cols-md-2 g-4">
              <div class="col">
                 <div class="card">
                  <img src="images/galleta.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">¿Es seguro comprar online?</h5>
            <p class="card-text">–Nuestra Tienda Virtual posee una encriptación de 256 bit, comprar aquí es más que seguro.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="images/helado1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">¿Puedo enviar un pedido como regalo?</h5>
            <p class="card-text">-Así es, al finalizar la compra, tendrás la opción de mandar tu pedido como regalo, ingresando una dedicatoria.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="images/helado2.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">¿Puedo programar la entrega de un pedido?</h5>
            <p class="card-text">–Claro que sí, al finalizar la compra, podrás elegir la fecha y hora aproximada para recibir o mandar tu pedido.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card" >
          <img src="images/galleta3.jpg" class="card-img-top" alt="..."  >
          <div class="card-body">
            <h5 class="card-title">¿Cómo puedo enterarme de las ofertas?</h5>
            <p class="card-text">–Para enterarte de nuestras ofertas, promociones y cupones de descuento, suscribíte a nuestro newsletter al final de cada página.

    </p>
          </div>
        </div>
      </div>
    </div>


                </div>
                </div>
            
           
            
    </main>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
<?php
  incluirTemplate("footer");
?>

</html>
