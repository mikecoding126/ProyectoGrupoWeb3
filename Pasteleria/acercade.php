
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
        <p class="lead">Endulzando momentos especiales desde 1975</p>
    </section>

    <!-- Historia -->
    <section class="mb-5">
        <div class="card border-0 shadow-sm p-4 historia-card">
            <h2 class="text-center mb-4">Nuestra Historia</h2>
            <p class="text-muted">Nuestra deliciosa historia nace el año 1975 en lo que solía ser el pueblo pequeño de La Paz, Bolivia. Con mucho cariño y buen gusto, Marcos y Fernando, fusionaron los gustos tradicionales con los de su hogar, Austria. Valorando la tradición y el sabor del arte de la pastelería, Collita se convirtió en la cadena pastelera más grande de nuestro país.</p>
        </div>
    </section>

    <!-- Misión, Visión y Objetivos -->
    <section class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow h-100 mission-card">
                <div class="card-body text-center">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="card-title">Misión</h3>
                    <p class="card-text">Crear momentos inolvidables a través de nuestros productos artesanales, ofreciendo la más alta calidad en pastelería y repostería, mientras mantenemos viva la tradición y la innovación en cada creación mediante ventas en linea.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow h-100 vision-card">
                <div class="card-body text-center">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="card-title">Visión</h3>
                    <p class="card-text">Ser reconocidos como la pastelería líder en innovación y calidad en Bolivia, expandiendo nuestra presencia mientras mantenemos la esencia artesanal que nos caracteriza de manera rapida.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow h-100 objectives-card">
                <div class="card-body text-center">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="card-title">Objetivos</h3>
                    <ul class="list-unstyled text-left">
                    <li>🎯Delivery Inmediato</li>
                        <li>🎯 Mantener la excelencia en calidad</li>
                        <li>🎯 Innovar en sabores y diseños</li>
                        <li>🎯 Expandir nuestra presencia nacional</li>
                        <li>🎯 Formar personal especializado</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


</main>

<style>

.historia-card {
    background: linear-gradient(135deg, #fff9f9, #fff5f5);
    border-radius: 15px;
}

.mission-card, .vision-card, .objectives-card {
    transition: transform 0.3s ease;
    border-radius: 15px;
    background: linear-gradient(135deg, #fff9f9, #fff5f5);
}

.mission-card:hover, .vision-card:hover, .objectives-card:hover {
    transform: translateY(-5px);
}

.icon-wrapper {
    width: 60px;
    height: 60px;
    background: #ff8fab;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.icon-wrapper i {
    color: white;
    font-size: 24px;
}

.card-title {
    color: #ff8fab;
    font-weight: 600;
    margin-bottom: 1rem;
}

ul li {
    margin-bottom: 0.5rem;
    color: #5c4646;
}

</style>
<?php
    incluirTemplate("footer");
?>

    <script src="build/js/bundle.min.js"></script> 
</body>
</html>
