<?php 
if(isset($_POST["btnGestionarInventario"])){

    
    include_once("./controllerGestionarInventario.php");
    $controlGestionarInventario = new controllerGestionarInventario;
    $controlGestionarInventario -> obtenerProductos();

}
elseif(isset($_POST["btnBuscar"])){
    $productos = ($_POST['producto']);
    include_once("./controllerGestionarInventario.php");
        $controlGestionarInventario = new controllerGestionarInventario;
    if(strlen(trim($productos))>=1){
        $controlGestionarInventario -> buscarProducto($productos);
    }else{
      $controlGestionarInventario -> obtenerProductos();
    }

    
}
else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}
?>