
    <title>Mapa de Sucursales</title>
    <link rel="stylesheet" href="build\css\stylesn.css"> 
    <style>
        /* Estilos para el contenido */
        .contenedor {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            overflow: hidden;
        }

        .titulo-central {
            text-align: center;
            margin-bottom: 20px;
        }

        .subtitulo-izquierda,
        .subtitulo-derecha {
            width: 50%;
            float: left;
        }

        .subtitulo-izquierda {
            padding-right: 20px;
        }

        .subtitulo-derecha {
            padding-left: 20px;
        }

        .cuadro-sucursal {
            width: 30%;
            float: left;
            margin-right: 3%;
            margin-bottom: 20px;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .cuadro-sucursal:hover {
            transform: translateY(-5px);
        }

        /* Estilos para el botón */
        .boton {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #ff5733;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Estilos para la imagen del mapa */
        #mapa img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<?php
    require('includes/funciones.php');
    incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1 class="titulo-central">SUCURSALES</h1>

    <div class="subtitulo-izquierda">
        <h2>MAPA DE UBICACIONES</h2>
        <p>Ubicá todas nuestras sucursales en el mapa de La Paz.</p>
        <p>¿Querés llegar directamente desde Google Maps?</p>
        <button class="boton">SUCURSALES</button>
    </div>

    <div class="subtitulo-derecha">
        <div id="mapa">
            <img src="../Pasteleria\images\MAPA.png" alt="Mapa de sucursales">
        </div>
    </div>

    <div style="clear:both;"></div>

    <h2 class="titulo-central">VER SUCURSALES</h2>

    <div class="cuadro-sucursal">
        <h3>Sucursal Central</h3>
        <p>Dirección: Av. Principal #123, Santa Cruz, Bolivia</p>
        <p>Teléfono: +591 123 4567</p>
        <p>Horario: Lunes a Viernes 8am - 6pm</p>
    </div>

    <div class="cuadro-sucursal">
        <h3>Sucursal Norte</h3>
        <p>Dirección: Calle Norte #456, La Paz, Bolivia</p>
        <p>Teléfono: +591 987 6543</p>
        <p>Horario: Lunes a Viernes 9am - 7pm, Sábado 9am - 2pm</p>
    </div>

    <div class="cuadro-sucursal">
        <h3>Sucursal Sur</h3>
        <p>Dirección: Av. Sur #789, Cochabamba, Bolivia</p>
        <p>Teléfono: +591 543 2109</p>
        <p>Horario: Lunes a Viernes 10am - 8pm</p>
    </div>
</main>

<?php
    incluirTemplate("footer");
?>

</body>
</html>
