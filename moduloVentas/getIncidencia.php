<?php

if(isset($_POST["btnRegistrarIncidencia"])){
    session_start(); 
    unset($_SESSION['lista']);
    include_once("formRegistrarIncidencia.php");
    $formIncidencia = new formRegistrarIncidencia($_SESSION["informacion"]);
    $formIncidencia -> formRegistrarIncidenciaShow();
}elseif(isset($_POST["btnRegistrar"])){
    $fecha = (string)($_POST['fecha']);
    $hora = (string)($_POST['hora']);
    $asunto = ($_POST['asunto']);
    $descripcion = ($_POST['descripcion']);

    if(strlen(trim($fecha)) >= 2 && strlen(trim($hora)) >= 2 && strlen(trim($asunto)) >= 4 && strlen(trim($descripcion)) >= 4){
        include_once("./controllerRegistrarIncidencia.php");
        $controlIncidencia = new controllerRegistrarIncidencia;
        $controlIncidencia -> registrarIncidencia($fecha,$hora,$asunto,$descripcion);
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("Ingrese datos válidos","<form action='getIncidencia.php' class='form-message__link' method='post' style='padding:0;'>
        <input name='btnRegistrarIncidencia'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'></form>");
    }

} else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}

?>