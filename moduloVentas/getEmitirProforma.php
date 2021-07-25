<?php
if(isset($_POST["btnEmitirProforma"])){
    include_once("./controllerEmitirProforma.php");
    session_start();
    if(!isset($_POST["regresar"]))
        $_SESSION["lista_proforma"] = ["productos"=>[],"servicios"=>[],"precioTotal"=>0];
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
        <input type='hidden' name='regresar' />
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
    session_start();
    $nom = $_POST["producto"];
    $idProducto = $_POST["idProducto"];
    $cantidad = (int)$_POST["cantidad"];
    if($cantidad >= 1){
        include_once("./controllerEmitirProforma.php");
        $controller = new controllerEmitirProforma;
        $controller->agregarProducto($idProducto,$nom,$cantidad);
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("¡INGRESE CANTIDAD VÁLIDO!","<form action='getEmitirProforma.php' class='form-message__link' method='post' style='padding:0;'>
        <input type='hidden' name='regresar' />
        <input name='btnEmitirProforma'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
    </form>");

    }

}elseif(isset($_POST["btnAgregarServicio"])){
    $id_servicio = $_POST["idservicio"];
    session_start();
    array_push($_SESSION["lista_proforma"]["servicios"],$id_servicio);
    $objPreciosUnitariosProductos = [];
    include_once("controllerEmitirProforma.php");
    $controller = new controllerEmitirProforma;
    if(count($_SESSION["lista_proforma"]["productos"])){
        $objPreciosUnitariosProductos = $controller -> obtenerPrecioUnitaciosProductos($_SESSION["lista_proforma"]["productos"]);
    }
    $objPreciosUnitariosServicios = $controller -> obtenerPrecioUnitaciosServicios($_SESSION["lista_proforma"]["servicios"]);
    $objTotal = $controller -> obtenerTotal($objPreciosUnitariosProductos, $objPreciosUnitariosServicios);
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($objTotal);
}elseif(isset($_POST["btnQuitarServicio"])){
    $id_servicio = $_POST["idservicio"];
    session_start();    
    if(count($_SESSION["lista_proforma"]["servicios"])==1){
        $_SESSION["lista_proforma"]["servicios"] = [];
    }else if(count($_SESSION["lista_proforma"]["servicios"])==2){
        if($_SESSION["lista_proforma"]["servicios"][0] == $id_servicio){
            $_SESSION["lista_proforma"]["servicios"] = [$_SESSION["lista_proforma"]["servicios"][1]];
        }else{
            $_SESSION["lista_proforma"]["servicios"] = [$_SESSION["lista_proforma"]["servicios"][0]];
        }
    }else{
        $_SESSION["lista_proforma"]["servicios"] = [];
    }
    include_once("controllerEmitirProforma.php");
    $controller = new controllerEmitirProforma;
    $objPreciosUnitariosProductos = [];
    if(count($_SESSION["lista_proforma"]["productos"])){
        $objPreciosUnitariosProductos = $controller -> obtenerPrecioUnitaciosProductos($_SESSION["lista_proforma"]["productos"]);
    }
    $objPreciosUnitariosServicios = [];
    if(count($_SESSION["lista_proforma"]["servicios"])){
        $objPreciosUnitariosServicios = $controller -> obtenerPrecioUnitaciosServicios($_SESSION["lista_proforma"]["servicios"]);
    }
    $objTotal = $controller -> obtenerTotal($objPreciosUnitariosProductos, $objPreciosUnitariosServicios);
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($objTotal);

}elseif(isset($_POST["btnBorrarLista"])){
    include_once("./controllerEmitirProforma.php");
    session_start();
    $_SESSION["lista_proforma"] = ["productos"=>[],"servicios"=>[],"total"=>0];
    $controller = new controllerEmitirProforma;
    if(strlen(trim($_POST["producto"]))){
        $producto = trim($_POST["producto"]);
        if(isset($_POST["idProducto"])){
            $idProducto = $_POST["idProducto"];
            $controller->seleccionarProducto($idProducto,$producto);
        }else{
            $controller->buscarProducto($producto);
        }
    }else{
        $controller->mostrarFormularioAddProductoYServicioAProforma();  
    }

}else if(isset($_POST["btnQuitarProducto"])){
    $id_producto = $_POST["idproducto"];
    session_start();
    if(count($_SESSION["lista_proforma"]["productos"]) > 1){
        unset($_SESSION["lista_proforma"]["productos"][$id_producto]);
    }else if(count($_SESSION["lista_proforma"]["productos"]) == 1){
        $_SESSION["lista_proforma"]["productos"] = [];
    }
    include_once("controllerEmitirProforma.php");
    $controller = new controllerEmitirProforma;
    $objPreciosUnitariosProductos = [];
    if(count($_SESSION["lista_proforma"]["productos"])){
        $objPreciosUnitariosProductos = $controller -> obtenerPrecioUnitaciosProductos($_SESSION["lista_proforma"]["productos"]);
    }
    $objPreciosUnitariosServicios = [];
    if(count($_SESSION["lista_proforma"]["servicios"])){
        $objPreciosUnitariosServicios = $controller -> obtenerPrecioUnitaciosServicios($_SESSION["lista_proforma"]["servicios"]);
    }
    $objTotal = $controller -> obtenerTotal($objPreciosUnitariosProductos, $objPreciosUnitariosServicios);
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($objTotal);
}else if(isset($_POST["btnCounterProducto"])){
    $id_producto = ($_POST['idproducto']);
    $cantidad = ($_POST['cantidad']);
    session_start();
    $_SESSION["lista_proforma"]["productos"][$id_producto] = (int)$cantidad;
    include_once("controllerEmitirProforma.php");
    $controller = new controllerEmitirProforma;
    $objPreciosUnitariosProductos = [];
    if(count($_SESSION["lista_proforma"]["productos"])){
        $objPreciosUnitariosProductos = $controller -> obtenerPrecioUnitaciosProductos($_SESSION["lista_proforma"]["productos"]);
    }
    $objPreciosUnitariosServicios = [];
    if(count($_SESSION["lista_proforma"]["servicios"])){
        $objPreciosUnitariosServicios = $controller -> obtenerPrecioUnitaciosServicios($_SESSION["lista_proforma"]["servicios"]);
    }
    $objTotal = $controller -> obtenerTotal($objPreciosUnitariosProductos, $objPreciosUnitariosServicios);
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($objTotal);

}elseif(isset($_POST["btnAgregarCliente"])){
    session_start();
    include_once("formAgregarCliente.php");
    $form = new formAgregarCliente;
    $form->formAgregarClienteShow($_SESSION["informacion"]);

}elseif(isset($_POST["btnVerLista"])){
    session_start();
    if(count($_SESSION["lista_proforma"]["productos"]) or count($_SESSION["lista_proforma"]["servicios"])){
        include_once("./controllerEmitirProforma.php");
        $controller = new controllerEmitirProforma;
        $controller->verLista();
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("¡La lista debe de tener al menos un producto o un servicio!","<form action='getEmitirProforma.php' class='form-message__link' method='post' style='padding:0;'>
        <input type='hidden' name='regresar' />
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

