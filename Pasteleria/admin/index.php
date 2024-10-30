<?php 
    /* session_start();
    
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location:/pasteleria_2do");
    }*/
require '../includes/funciones.php';
incluirTemplate('HeaderAdmin');
?>

<style>
    /* Estilos generales */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    /* Contenedor principal */
    .contenedor {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Sección */
    .seccion {
        background-color: #fff;
        padding: 2rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    /* Título */
    .titulo-admin {
        font-size: 2.5rem;
        color: #333;
        text-align: center;
        margin-bottom: 2rem;
    }

    /* Botones */
    .botones-admin {
        display: flex;
        justify-content: center;
        gap: 1rem;
    }

    .boton {
        display: inline-block;
        padding: 1rem 2rem;
        font-size: 1.2rem;
        color: #fff;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .boton-verde {
        background-color: #28a745;
    }

    .boton-verde:hover {
        background-color: #218838;
    }

    .boton-amarillo {
        background-color: #ffc107;
    }

    .boton-amarillo:hover {
        background-color: #e0a800;
    }
    .boton-azul {
    background-color: #007BFF; /* Azul */
    color: white;
}

.boton-verde {
    background-color: #28A745; /* Verde */
    color: white;
}

.boton-rojo {
    background-color: #DC3545; /* Rojo */
    color: white;
}

.boton-naranja {
    background-color: #FFA500; /* Naranja */
    color: white;
}

.boton-morado {
    background-color: #6F42C1; /* Morado */
    color: white;
}
</style>

<main class="contenedor seccion">
    <h1 class="titulo-admin">Administrador Pastelería Collita</h1>
    <div class="botones-admin">
    
        <a href="./productos/listado.php" class="boton boton-verde">Productos</a>
        
        <a href="./promociones/listado.php" class="boton boton-morado">Promociones</a>
        <a href="" class="boton boton-naranja">Usuario</a>
        
        <a href="./vista/adminLista.php" class="boton boton-rojo">Administradores</a>
        <a href="./proveedor/listado.php" class="boton boton-azul">Proveedores</a>

        
    </div>
</main>

<?php 
incluirTemplate('footer');
?>
