<?php 

if (isset($_POST["btnGestionarDatosDelUsuario"])) {
    if (!isset($_SESSION)) {
        session_start();
    }
    unset($_SESSION['lista']);
    include_once("./controllerGestionarDatosUsuario.php");
    $controlReporteVentas = new controllerGestionarDatosUsuario;
    $controlReporteVentas->obtenerGestionarDatosUsuarios();
}else {
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje->formMensajeSistemaShow("¡ACCESO NO PERMITIDO!", "<a href='../index.php' class='form-message__link'>Volver</a>");
}

?>