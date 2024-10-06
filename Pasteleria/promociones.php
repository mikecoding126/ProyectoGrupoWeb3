<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/283335a286.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima+Madurai:wght@700&family=Mulish:wght@400;700&display=swap"
        rel="stylesheet">
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

        <div class="row">
        <?php
        require 'includes/config/database.php';
        $db = conectarDB();

        $con_sql = "SELECT * FROM promociones WHERE estado = 'Disponible'";
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

    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script src="build/js/bundle.min.js"></script>
</body>

<?php
    incluirTemplate("footer");
?>

</html>
