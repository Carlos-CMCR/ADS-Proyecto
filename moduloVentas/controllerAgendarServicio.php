<?php 
class controllerAgendarServicio{
    public function obtenerServicio(){
        include_once("../model/Servicio.php");
        $objServicio = new Servicio;
        $arrayServicio = $objServicio->listarServicio();
        //var_dump($arrayServicio);
        include_once("formListaServicios.php");
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
		$objListaServicios = new formListaServicios($_SESSION["informacion"]);
		$objListaServicios -> formListaServiciosShow($arrayServicio);
    }
    public function obtenerServicioDNI($dni){
        include_once("../model/Servicio.php");
        $objServicio = new Servicio;
        $resultado = $objServicio->listarServiciosDNI($dni);
        
        if($resultado["existe"]){
            include_once("formListaServicios.php");
            session_start();
            $objListaServicios = new formListaServicios($_SESSION["informacion"]);
            $objListaServicios -> formListaServiciosShow($resultado["data"]);
        }else{
            include_once("../shared/formMensajeSistema.php");
				$nuevoMensaje = new formMensajeSistema;
				$nuevoMensaje -> formMensajeSistemaShow(
                $resultado["mensaje"],
                    "<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
                        <input name='btnAgendarServicio'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                    </form>");
        }
        //var_dump($arrayServicio);
        
    }
    public function obtenerDatosComprobante($num_comprobante){
        //modelo Comprobante
        include_once("../model/ComprobanteDePago.php");
        $objComprobante = new ComprobanteDePago;
        $verificarComprobante = $objComprobante ->verificarComprobante($num_comprobante);
        $datosComprobante = $objComprobante -> obtenerComprobanteC($num_comprobante);
        
        if($verificarComprobante["existe"]){
            include_once("../shared/formMensajeSistema.php");
				$nuevoMensaje = new formMensajeSistema;
				$nuevoMensaje -> formMensajeSistemaShow(
                    $verificarComprobante["mensaje"],
                    "<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
                        <input name='btnAgregar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                    </form>");
        }else{
            if($datosComprobante["existe"]){
                include_once("formAgregarServicio.php");
                session_start();
                $objAgregarServicio = new formAgregarServicio($_SESSION["informacion"]);        
                $objAgregarServicio -> formAgregarServicioShow($datosComprobante["data"]); 
            }else{
                include_once("../shared/formMensajeSistema.php");
                    $nuevoMensaje = new formMensajeSistema;
                    $nuevoMensaje -> formMensajeSistemaShow(
                        $datosComprobante["mensaje"],
                        "<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
                            <input name='btnAgregar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                        </form>");
            }
        }
        
    }
}

?>