
    <title>Acerca de Nosotros -Pastelería Esencia </title>
    <link rel="stylesheet" href="build\css\stylesn.css"> 
    
</head>
<body>

    <?php
        require('includes/funciones.php');
        incluirTemplate('header');
    ?>

<main class="container my-5">
    <section class="text-center mb-5">
        <h1 class="display-4 font-weight-bold">Acerca de Nosotros</h1>
        <p class="lead">Nuestra deliciosa historia</p>
    </section>

    <section class="mb-5">
        <p class="text-muted text-justify">Nuestra deliciosa historia nace el año 1975 en lo que solía ser el pueblo pequeño de Santa Cruz, Bolivia. Con mucho cariño y buen gusto, Carla y Fernando, fusionaron los gustos cruceños con los de su hogar, Austria. Valorando la tradición y el sabor del arte de la pastelería, Fridolin se convirtió en la cadena pastelera más grande de nuestro país. Ahora Fridolin sigue enamorando a la ciudad con un sinfín de variedades de tortas, postres, y saladitos bolivianos.</p>
    </section>

    <section class="mb-5">
        <h2 class="text-center mb-4">Nuestros Valores</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title">🤝 Compromiso</h5>
                        <p class="card-text">Estamos comprometidos con nuestros clientes en ofrecerles siempre lo mejor, tanto en servicios como en nuestros productos.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title">🛡️ Responsabilidad</h5>
                        <p class="card-text">Cumplimos siempre las más altas normas de higiene y sanidad, desde nuestro personal hasta nuestras instalaciones.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title">🙏 Respeto</h5>
                        <p class="card-text">El respeto es una de nuestras virtudes, inculcamos este valor en nuestro personal y lo transmitimos a nuestros clientes.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title">⏰ Puntualidad</h5>
                        <p class="card-text">Fridolin se caracteriza por su rápido servicio, cumpliendo siempre con los pedidos de nuestra clientela.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title">🛠️ Integridad</h5>
                        <p class="card-text">Ser una empresa íntegra en todo sentido es clave para el equipo que conforma Fridolin.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title">🛎️ Servicio</h5>
                        <p class="card-text">Nuestros servicios son un referente de la buena atención, garantizando una excelente experiencia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <h2 class="text-center mb-4">¿Por qué pedir online?</h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">🔒 Seguridad</h5>
                        <p class="card-text">Nuestro sitio posee un alto nivel de seguridad con encriptación de 256 bits, fomentando además el distanciamiento social. ¡Nosotros llegamos a vos!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">💻 Eficiencia</h5>
                        <p class="card-text">Comprar nunca fue tan fácil: buscá productos, elegí cantidades, ingresá tus datos y seleccioná tu método de pago.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">💰 Ofertas</h5>
                        <p class="card-text">Revisá nuestra sección de promociones y suscribite a nuestro newsletter para mantenerte informado de todas las novedades.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">📅 Anticipación</h5>
                        <p class="card-text">Programá tus pedidos con anticipación. Elegí la fecha y hora para recibir tu pedido cómodamente.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php
    incluirTemplate("footer");
?>

    <script src="build/js/bundle.min.js"></script> <!-- Incluye el script JavaScript -->
</body>
</html>
