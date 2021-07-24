<?php
if(isset($_POST["btnEmitirProforma"])){
    include_once("./controllerEmitirProforma.php");
    session_start();
    if(!isset($_SESSION["lista_proforma"])){
        $_SESSION["lista_proforma"] = ["productos"=>[],"servicios"=>[],"total"=>0];
    }
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
}elseif(isset($_POST["btnSeleccionarProducto"])){
    $nom = $_POST["producto"];
    $idProducto = $_POST["idProducto"];
    include_once("./controllerEmitirProforma.php");
    $controller = new controllerEmitirProforma;
    $controller->seleccionarProducto($idProducto,$nom);
}elseif(isset($_POST["btnAgregar"])){
    $nom = $_POST["producto"];
    $idProducto = $_POST["idProducto"];
    $cantidad = (int)$_POST["cantidad"];
    if($cantidad >= 1){
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("¡INGRESE CANTIDAD VÁLIDO!","<form action='getEmitirProforma.php' class='form-message__link' method='post' style='padding:0;'>
        <input name='btnEmitirProforma'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
    </form>");

    }

}elseif(isset($_POST["btnBorrarLista"])){
    include_once("./controllerEmitirProforma.php");
    session_start();
    $_SESSION["lista_proforma"] = ["productos"=>[],"servicios"=>[],"total"=>0];
    $controller = new controllerEmitirProforma;
    if(strlen(trim($_POST["producto"]))){
        $producto = trim($_POST["producto"]);
        $controller->buscarProducto($producto);
    }else{
        $controller->mostrarFormularioAddProductoYServicioAProforma();  
    }
}
else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}

?>