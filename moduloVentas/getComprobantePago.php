<?php 
if(isset($_POST["btnEmitirComprobante"])){
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    unset($_SESSION['lista']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> obtenerProformas();

}elseif(isset($_POST["btnBuscar"])){
    $fecha_seleccionada = ($_POST['fecha']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> obtenerProformasFecha($fecha_seleccionada);
}
elseif(isset($_POST["btnSeleccionar"])){
    $id_proforma = ($_POST['idProforma']);
    $id_cliente = ($_POST['idCliente']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> tipoComprobantePago($id_proforma, $id_cliente);
}else if(isset($_POST["btnFactura"])){
    $button = true;
    $id_proforma = ($_POST['idProforma']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> obtenerProforma($id_proforma,$id_cliente, $button);
}else if(isset($_POST["btnBoleta"])){
    $id_proforma = ($_POST['idProforma']);
    $id_cliente = ($_POST['idCliente']);
    $button =  false;
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> obtenerProforma($id_proforma,$id_cliente, $button);

}else if(isset($_POST["btnRegresarBoleta"])){
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $id_proforma = ($_POST['idProforma']);
    $id_cliente = ($_POST['idCliente']);
    $button =  false;
    $controlComprobante->listarProductosDeNuevaLista($id_proforma,$id_cliente,$button);
}else if(isset($_POST["btnAgregarProducto"])){
    $id_proforma = ($_POST['idProforma']);
    $id_cliente = ($_POST['idCliente']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> agregarProductos($id_proforma, $id_cliente);
}else if(isset($_POST["btnBuscarProducto"])){
    $productos = ($_POST['producto']);
    $id_proforma = ($_POST['idProforma']);
    $id_cliente = ($_POST['idCliente']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    if($productos >= 1){
        $controlComprobante -> buscarProducto($productos, $id_proforma, $id_cliente);
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("¡INGRESE UN NOMBRE VÁLIDO!","<form action='getComprobantePago.php' class='form-message__link' method='post' style='padding:0;'>
        <input type='hidden' name='idProforma' value='$id_proforma' >
        <input name='btnAgregarProducto'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
    </form>");

    }
}else if(isset($_POST["btnQuitarProducto"])){

}else if(isset($_POST["btnCounterProducto"])){
    $id_producto = ($_POST['idproducto']);
    $cantidad = ($_POST['cantidad']);
    session_start();
    // header('Content-type: application/json; charset=utf-8');
    $_SESSION["lista"]["productos"][$id_producto] = (int)$cantidad;
    // echo json_encode($_SESSION["lista"]["productos"]);
    // include_once("./controllerEmitirComprobantePago.php");
    // $controlComprobante = new controllerEmitirComprobantePago;
    // $objPreciosUnitarios = $controlComprobante -> obtenerPrecioUnitaciosProductos($_SESSION["lista"]["productos"]);
    
    // $arrayCalculos = 

    // echo json_encode($objPreciosUnitarios);


}else if(isset($_POST["btnSeleccionarProducto"])){
    $id_producto = ($_POST['idProducto']);
    $id_proforma = ($_POST['idProforma']);
    $id_cliente = ($_POST['idCliente']);
    $productos = ($_POST['producto']);

    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> seleccionarProducto($id_producto, $id_proforma, $id_cliente,$productos);
}else if(isset($_POST["btnAgregar"])){
    $id_producto = ($_POST['idProducto']);
    $id_proforma = ($_POST['idProforma']);
    $id_cliente = ($_POST['idCliente']);
    $productos = ($_POST['producto']);
    $cantidad = ($_POST['cantidad']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> agregarProducto( $cantidad, $id_producto, $id_proforma, $id_cliente,$productos);
} else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}


?>