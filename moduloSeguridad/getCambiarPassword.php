<?php 
    if(isset($_POST['btnCambiarPassword'])){
        include_once("./formCambiarPassword.php");
        session_start();
        $objCambiarPassword = new formCambiarPassword($_SESSION["informacion"]);
        $objCambiarPassword->formCambiarPasswordShow();
    }else if(isset($_POST['btnConfirmar'])){
        session_start();
        $md5Password = md5(trim($_POST['password']));
        $username = $_SESSION['username'];
        include_once("./controllerCambiarPassword.php");
        $nuevaValidacion = new controllerCambiarPassword;
        $nuevaValidacion -> validarPasswordDelUsuario($username,$md5Password);
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("ACCESO NO PERMITIDO !!!","<a href='../index.php' class='form-message__link'>Volver</a>");
    }

?>