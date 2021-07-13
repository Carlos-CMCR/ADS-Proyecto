<?php 
if(isset($_POST["btnEmitirComprobante"])){
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> obtenerProformas();

}elseif(isset($_POST["btnBuscar"])){
    $fecha_seleccionada = ($_POST['fecha']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> obtenerProformasFecha($fecha_seleccionada);
}
else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}


?>