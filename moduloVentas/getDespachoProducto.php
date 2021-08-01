<?php 
if(isset($_POST["btnRegistrarDespacho"])){
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    unset($_SESSION['lista']);
    include_once("./controllerRegistrarDespachoProducto.php");
    $controlComprobante = new controllerRegistrarDespacho;
    $controlComprobante -> obtenerComprobantes();
}elseif(isset($_POST["btnBuscar"])){
    $fecha_seleccionada = ($_POST['fecha']);
    include_once("./controllerRegistrarDespachoProducto.php");
    $controlComprobante = new controllerRegistrarDespacho ;
    $controlComprobante -> obtenerComprobantesFecha($fecha_seleccionada);
}else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}

?>