<header>
    
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" 
        integrity="sha512-Mhn4ZHhpZ9iQV69UsVsS7K2xJfco14ZBUWD8lG8tNIm0lJctPwvmccuXkqM2nFmfT55YUyw3nSbmwEEtQ1S9sg=="
         crossorigin="anonymous" 
         referrerpolicy="no-referrer" />
         
         <nav class="navbar navbar-expand-lg navbar-light bg-light ">
            <div class="container" >

                <a class="navbar-brand" href="../../index.php"><i class="fas fa_utesils" ></i> 
                <img src="./logo.png" alt="Logo de collita" width="auto" style="max-width: 70px; height: auto;">Pastelería El Collita    cvx🍰</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav " aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                
                 <ul class="nav navbar-nav ml-auto">

                    <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link" href="productos.php">Productos</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link" href="promociones.php">Promociones</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link" href="acercade.php">Acerca de</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link" href="sucursales.php">Sucursales</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link" href="contacto.php">Contactos</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="carrito.php">
                        <i class="fas fa-shopping-cart"></i>Carrito
                        <?php
                        // Contar productos en el carrito
                        $total_items = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
                        if ($total_items > 0) {
                            echo "<span class='badge bg-primary'>$total_items</span>";
                        }
                        ?>
                    </a>
                </li>
                    <?php /*if($auth):?>
                                <li><a class="nav-link" href="cerrarsesion2.php">Cerrar Sesión</a></li>
                            <?php else: */?>
                                <li><a class="nav-link" href="login.php">Iniciar Sesión</a> </li>
                                <?php /* endif;*/?>
                    </ul>
                </div>
           </div>
        </nav>
</header>