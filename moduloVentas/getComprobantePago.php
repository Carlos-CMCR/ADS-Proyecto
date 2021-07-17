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
elseif(isset($_POST["btnSeleccionar"])){
    $id_proforma = ($_POST['idProforma']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> tipoComprobantePago($id_proforma);
}else if(isset($_POST["btnFactura"])){
    $button = true;
    $id_proforma = ($_POST['idProforma']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> obtenerProforma($id_proforma, $button);
}else if(isset($_POST["btnBoleta"])){
    $button = false;
    $id_proforma = ($_POST['idProforma']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> obtenerProforma($id_proforma, $button);
}else if(isset($_POST["btnAgregarProducto"])){
    $id_proforma = ($_POST['idProforma']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    $controlComprobante -> agregarProductos($id_proforma);
}else if(isset($_POST["btnBuscarProducto"])){
    $producto = ($_POST['producto']);
    $id_proforma = ($_POST['idProforma']);
    include_once("./controllerEmitirComprobantePago.php");
    $controlComprobante = new controllerEmitirComprobantePago;
    if($producto >= 1){
        $controlComprobante -> buscarProducto($producto, $id_proforma);
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("¡INGRESE UN NOMBRE VÁLIDO!","<form action='getComprobantePago.php' class='form-message__link' method='post' style='padding:0;'>
        <input type='hidden' name='idProforma' value='$id_proforma' >
        <input name='btnAgregarProducto'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
    </form>");
    }
    
}else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}


?>