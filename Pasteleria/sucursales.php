
    <title>Mapa de Sucursales</title>
    <link rel="stylesheet" href="build\css\stylesn.css"> 
    <style>
      
body {
    background-color: #fdf0d5;
    font-family: 'Pacifico', cursive, 'Arial', sans-serif;
    color: #5c4b51;
    margin: 0;
    padding: 0;
}


.contenedor {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    overflow: hidden;
}


.titulo-central {
    text-align: center;
    font-size: 2.5rem;
    color: #d35400;
    margin-bottom: 30px;
    font-family: 'Pacifico', cursive;
}


.subtitulo-izquierda,
.subtitulo-derecha {
    width: 50%;
    float: left;
    font-size: 1.2rem;
    font-family: 'Quicksand', sans-serif;
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
    background-color: #fff3e6;
    border: 2px solid #f7d1ba;
    border-radius: 15px;
    padding: 20px;
    transition: transform 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.cuadro-sucursal:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}


.cuadro-sucursal h3 {
    font-size: 1.5rem;
    color: #e74c3c;
    margin-bottom: 10px;
}


.boton {
    display: block;
    width: 220px;
    margin: 20px auto;
    padding: 12px;
    background-color: #e74c3c;
    color: white;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-family: 'Quicksand', sans-serif;
    font-size: 1.2rem;
    transition: background-color 0.3s ease;
}

.boton:hover {
    background-color: #d35400;
}


#mapa img {
    width: 100%;
    height: auto;
    border-radius: 15px;
}


p {
    font-size: 1rem;
    line-height: 1.6;
    font-family: 'Quicksand', sans-serif;
    color: #5c4b51;
}


.clearfix::after {
    content: "";
    display: table;
    clear: both;
}


body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('../Pasteleria/images/pastel-background.png');
    background-size: cover;
    z-index: -1;
    opacity: 0.1;
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
