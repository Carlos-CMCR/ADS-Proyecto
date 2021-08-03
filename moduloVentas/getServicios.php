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
}
else if(isset($_POST["btnAgregarServicio"])){
    $id_comprobanteservicio = ($_POST['idComprobanteServicio']);
    $num_comprobante = ($_POST['numComprobante']);
    $id_cliente = ($_POST['idCliente']);
    $fecha= ($_POST['fecha']);
    $hora= ($_POST['hora']);
    $direccion= ($_POST['direccion']);
    $estado= "1";
    $descripcion= ($_POST['descripcion']);
    
    if(strlen(trim($direccion)) >= 5 and strlen(trim($descripcion)) >= 4 ){
        include_once("../shared/formAlerta.php");
                $alert = new formAlerta;
                $alert->formAlertaGeneralShow("¿Esta seguro que desea actualizar el Servicio?","
                <form action='getServicios.php' method='post'>
                
                <input type='hidden' name='idComprobanteServicio' value='$id_comprobanteservicio'>
                <input type='hidden' name='numComprobante' value='$num_comprobante'>
                <input type='hidden' name='idCliente' value='$id_cliente'>
                <input type='hidden' name='fecha' value='$fecha'>
                <input type='hidden' name='hora' value='$hora'>
                <input type='hidden' name='direccion' value='$direccion'>
                <input type='hidden' name='descripcion' value='$descripcion'>
                <button type='submit' name='btnContinuarNuevo' >Continuar</button>
                </form>
                <form action='getServicios.php' method='post'>
                    <input type='hidden' name='numComprobante' value='$num_comprobante'>
                    <button type='submit' name='btnBuscarNum' >Cancelar</button>
                </form>
                ");
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("¡INGRESE DATOS VÁLIDOS!","<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
          <input name='btnAgregar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'></form>");
    }

}
else if(isset($_POST["btnContinuarNuevo"])){
    $id_comprobanteservicio = ($_POST['idComprobanteServicio']);
    $num_comprobante = ($_POST['numComprobante']);
    $id_cliente = ($_POST['idCliente']);
    $fecha= ($_POST['fecha']);
    $hora= ($_POST['hora']);
    $direccion= ($_POST['direccion']);
    $estado= "1";
    $descripcion= ($_POST['descripcion']);
    include_once("./controllerAgendarServicio.php");
    $controlServicio = new controllerAgendarServicio();
    $controlServicio -> agregarServicio($num_comprobante, $id_comprobanteservicio,$id_cliente ,$fecha,$hora,$direccion,$estado,$descripcion);

}
else if(isset($_POST["btnEditar"])){
    $id_servicio= ($_POST['idServicio']);
       
    include_once("./controllerAgendarServicio.php");
    $controlServicio = new controllerAgendarServicio;
    $controlServicio -> obtenerServicioID($id_servicio);

}else if(isset($_POST["btnActualizarServicio"])){
    $id_servicio= ($_POST['idServicio']);
    $fecha= ($_POST['fecha']);
    $hora= ($_POST['hora']);
    $direccion= ($_POST['direccion']);
    $estado= ($_POST['estado']);
    $descripcion= ($_POST['descripcion']);
    
    if(strlen(trim($direccion)) >= 5 and strlen(trim($descripcion)) >= 4 ){
        include_once("../shared/formAlerta.php");
                $alert = new formAlerta;
                $alert->formAlertaGeneralShow("¿Esta seguro que desea actualizar el Servicio?","
                <form action='getServicios.php' method='post'>
                
                <input type='hidden' name='idServicio' value='$id_servicio'>
                <input type='hidden' name='fecha' value='$fecha'>
                <input type='hidden' name='hora' value='$hora'>
                <input type='hidden' name='direccion' value='$direccion'>
                <input type='hidden' name='estado' value='$estado'>
                <input type='hidden' name='descripcion' value='$descripcion'>
                <button type='submit' name='btnContinuarEditar' >Continuar</button>
                </form>
                <form action='getServicios.php' method='post'>
                <input name='idServicio'   value='$id_servicio' type='hidden'>
                <button type='submit' name='btnEditar' >Cancelar</button>
                </form>
                ");
       
    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("¡INGRESE DATOS VÁLIDOS!","<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
        <input name='idServicio'   value='$id_servicio' type='hidden'>
        <input name='btnEditar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'></form>");
    }

}else if(isset($_POST["btnContinuarEditar"])){
    $id_servicio= ($_POST['idServicio']);
    $fecha= ($_POST['fecha']);
    $hora= ($_POST['hora']);
    $direccion= ($_POST['direccion']);
    $estado= ($_POST['estado']);
    $descripcion= ($_POST['descripcion']);
    include_once("./controllerAgendarServicio.php");
    $controlServicio = new controllerAgendarServicio;
    $controlServicio -> actualizarServicio($id_servicio,$fecha,$hora,$direccion,$estado,$descripcion);
}
else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}
?>