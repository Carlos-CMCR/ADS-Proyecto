<?php 



if(isset($_POST["btnEmitirProforma"])){
    include_once("./controllerEmitirProforma.php");
    session_start();
    $controller = new controllerEmitirProforma;
    $controller->mostrarFormularioAddProductoYServicioAProforma();
}elseif(isset($_POST["btnBuscarProducto"])){
    $producto = $_POST["producto"];
    if(strlen(trim($producto))>=1){
        include_once("./controllerEmitirProforma.php");
        session_start();
        $controller = new controllerEmitirProforma;
        $controller->buscarProducto($producto);
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("¡El nombre debe contener al menos un caracter!","<form action='getEmitirProforma.php' class='form-message__link' method='post' style='padding:0;'>
        <input name='btnEmitirProforma'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
    </form>");
    }
}
else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}

?>