<?php

if(isset($_POST["btnRegistrarIncidencia"])){
    session_start(); 
    unset($_SESSION['lista']);
    include_once("formRegistrarIncidencia.php");
    $formIncidencia = new formRegistrarIncidencia($_SESSION["informacion"]);
    $formIncidencia -> formRegistrarIncidenciaShow();
} else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}

?>