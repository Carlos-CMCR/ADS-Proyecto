<?php 
    if(isset($_POST['btnCambiarPassword'])){
        include_once("./formCambiarPassword.php");
        session_start();
        $objCambiarPassword = new formCambiarPassword($_SESSION["informacion"]);
        $objCambiarPassword->formCambiarPasswordShow();
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("ACCESO NO PERMITIDO !!!","<a href='../index.php' class='form-message__link'>Volver</a>");
    }

?>