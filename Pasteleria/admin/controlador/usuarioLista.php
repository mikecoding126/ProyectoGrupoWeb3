<?php
   
  include("../modelo/usuario.php");
    $us = new Usuario("", "", "", "", "", "");
    $res = $us->listaUsuarios();
    include("../vista/usuarioLista.php");  
    incluirTemplate("footer");
?>