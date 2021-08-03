<?php 
if(isset($_POST["btnAgendarServicio"])){
    include_once("./controllerAgendarServicio.php");
    $controlServicio = new controllerAgendarServicio;
    $controlServicio -> obtenerServicio();
} else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}
?>