<?php
    require '../../includes/config/database.php';
    $db=conectarDB();
    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

 <a href="/made/Pasteleria/admin/controlador/nuevo.php" class="boton boton-verde">Volver</a>
    <form method="post" action="registrarusuario.php" class="formulario">
        <fieldset>
            <legend>informacion general</legend>
            <label for="">Email</label>
            <input type="text" name="em" id="em" placeholder="email">
            <label for="">pasword</label>
            <input type="text" name="pas" id="pas" placeholder="pasword">
           
        </fieldset>
        <input type="submit" value="registrar usuario" class="boton boton-verde" >

    </form>
    <?php
    incluirTemplate('footer');
?>