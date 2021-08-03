<?php 
if(isset($_POST["btnAgendarServicio"])){
    include_once("./controllerAgendarServicio.php");
    $controlServicio = new controllerAgendarServicio;
    $controlServicio -> obtenerServicio();
}else if(isset($_POST["btnBuscar"])){
    $dni = ($_POST['dni']);
    include_once("./controllerAgendarServicio.php");
    $controlServicio = new controllerAgendarServicio;
    if(strlen(trim($dni)) == 8){
        $controlServicio -> obtenerServicioDNI($dni);
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("¡INGRESE UN DNI VÁLIDO!","<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
        <input name='btnAgendarServicio'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'></form>");
    }
}else if(isset($_POST["btnAgregar"])){
    
    include_once("formAgregarServicio.php");
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
        $objAgregarServicio = new formAgregarServicio($_SESSION["informacion"]);
        
		$objAgregarServicio -> formAgregarServicioShow([] ,[]); 
}else if(isset($_POST["btnBuscarNum"])){
    $num_comprobante = ($_POST['numComprobante']);
    include_once("./controllerAgendarServicio.php");
    $controlServicio = new controllerAgendarServicio;
    if(strlen(trim($num_comprobante)) == 8){
        $controlServicio -> obtenerDatosComprobante($num_comprobante);
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("¡NUMERO DE COMPROBANTE INVÁLIDO!","<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
        <input name='btnAgregar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'></form>");
    }
} else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}
?>