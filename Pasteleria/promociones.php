

<title>Promociones</title>


    <link rel="stylesheet" href="build/css/stylesn.css">
    <style>
        body {
            font-family: 'Mulish', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .anuncio {
            border: 1px solid #ccc;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-color: #ffffff;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }

        .anuncio:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            background-color: #f0f8ff;
        }

        .anuncio img {
            max-width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .precio {
            font-weight: bold;
            color: #ffc107;
            font-size: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            color: #007bff;
            margin-top: 10px;
        }

        .card-text {
            color: #555;
        }

        .seccion {
            padding: 50px 0;
        }

        h2 {
            font-family: 'Arima Madurai', cursive;
            font-size: 2.5rem;
            color: #6c757d;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .text-end a {
            color: #fff;
        }
    </style>
</head>

<?php
    require('includes/funciones.php');
    incluirTemplate('header');
?>

<body>

    <section class="seccion contenedor mt-5">
        <h2 class="text-center mb-5">PROMOCIONES</h2>

<h3 style="text-align: center;">
<?php
    date_default_timezone_set('America/La_Paz');
    $fecha_actual = date("d-m-Y H:i:s");
    echo $fecha_actual;
?>
</h3>
        <div class="row">
        <?php
        require 'includes/config/database.php';
        $db = conectarDB();

        $con_sql = "SELECT * FROM promociones WHERE estado = 'activa'";
        $res = mysqli_query($db, $con_sql);
        if ($res) {
            while ($reg = mysqli_fetch_assoc($res)) {
                ?>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 anuncio">
                        <img src="admin/promociones/imagenes/<?php echo $reg['imagen']; ?>" class="card-img-top" alt="<?php echo $reg['nombre']; ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $reg['nombre']; ?></h5>
                            <p class="card-text"><?php echo $reg['descripcion']; ?></p>
                            <p class="card-text"><?php echo  'FehaFin '.$reg['fecha_fin']; ?></p>
                            <p class="card-text"><?php echo 'MontoDescuento '. $reg['monto_descuento']; ?></p>
                            <p class="precio card-text">Bs.-<?php echo $reg['precio']; ?></p>
                        </div>
                    </div>
                </div>

            <?php
            }
            mysqli_free_result($res);
        } else {
            echo "Error en la consulta: " . mysqli_error($db);
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script src="build/js/bundle.min.js"></script>
</body>

<?php
    incluirTemplate("footer");
?>

</html>
