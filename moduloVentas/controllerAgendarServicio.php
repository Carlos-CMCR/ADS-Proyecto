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

    public function agregarServicio($num_comprobante, $id_comprobanteservicio,$id_cliente ,$fecha,$hora,$direccion,$estado,$descripcion){
        include_once("../model/Servicio.php");
        $objServicio = new Servicio;
        $serviciosHora = $objServicio -> obtenerServicioporHora($hora,$fecha);
        
        if($serviciosHora["existe"]){
            if(count($serviciosHora["data"])==0 || count($serviciosHora["data"])==1 ){
                $resultado = $objServicio -> agregarServicio($id_comprobanteservicio,$id_cliente ,$fecha,$hora,$direccion,$estado,$descripcion);
                if($resultado["success"]){
                include_once("../shared/formMensajeSistema.php");
				$nuevoMensaje = new formMensajeSistema;
				$nuevoMensaje -> formMensajeSistemaShow(
                "Se agendo con exito",
                    "<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
                        <input name='btnAgendarServicio'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                    </form>", true);
                }
                }else{
                    include_once("../shared/formMensajeSistema.php");
				    $nuevoMensaje = new formMensajeSistema;
				    $nuevoMensaje -> formMensajeSistemaShow(
                    "Hora no disponible",
                    "<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
                        <input type='hidden' name='numComprobante' value='$num_comprobante'>
                        <input name='btnBuscarNum'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                    </form>");
                }
            }else{
                $resultado = $objServicio -> agregarServicio($id_comprobanteservicio,$id_cliente ,$fecha,$hora,$direccion,$estado,$descripcion);
                if($resultado["success"]){
                    include_once("../shared/formMensajeSistema.php");
                    $nuevoMensaje = new formMensajeSistema;
                    $nuevoMensaje -> formMensajeSistemaShow(
                    "Se agendo con exito",
                        "<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
                            <input name='btnAgendarServicio'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                        </form>", true);
                    }else{
                        include_once("../shared/formMensajeSistema.php");
                        $nuevoMensaje = new formMensajeSistema;
                        $nuevoMensaje -> formMensajeSistemaShow(
                        "Error al agregar servicio",
                        "<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
                            <input name='btnAgendarServicio'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                        </form>");
                    }
            }

    
    }
    public function obtenerServicioID($id_servicio){
        include_once("../model/Servicio.php");
        $objServicio = new Servicio;
        $datosServicio = $objServicio -> obtenerServicio($id_servicio);
        $estadosServicio = $objServicio -> obtenerEstadoServicio();
        include_once("formEditarServicio.php");
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
		$objEditarServicio = new formEditarServicio($_SESSION["informacion"]);
		$objEditarServicio -> formEditarServicioShow($datosServicio ,$estadosServicio, $id_servicio); 
    }
    public function actualizarServicio($id_servicio,$fecha,$hora,$direccion,$estado,$descripcion){
        include_once("../model/Servicio.php");
        $objServicio = new Servicio;
        
        $serviciosHora = $objServicio -> obtenerServicioporHora($hora, $fecha);
        if($serviciosHora["existe"]){
        if(count($serviciosHora["data"])==0 || count($serviciosHora["data"])==1 ){
            $resultado = $objServicio -> updateServicio($id_servicio,$fecha,$hora,$direccion,$estado,$descripcion);
            if($resultado["success"]){
                include_once("../shared/formMensajeSistema.php");
                $nuevoMensaje = new formMensajeSistema;
                $nuevoMensaje -> formMensajeSistemaShow(
                    "Se actualizo con exito",
                    "<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
                    <input name='btnAgendarServicio'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                    </form>", true);
                }
            }else{
                include_once("../shared/formMensajeSistema.php");
                $nuevoMensaje = new formMensajeSistema;
                $nuevoMensaje -> formMensajeSistemaShow(
                    "Hora no disponible",
                    "<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
                    <input type='hidden' name='idServicio' value='$id_servicio'>
                    <input name='btnEditar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                    </form>");
            }
        }else{
            $resultado = $objServicio -> updateServicio($id_servicio,$fecha,$hora,$direccion,$estado,$descripcion);
            if($resultado["success"]){
                include_once("../shared/formMensajeSistema.php");
                $nuevoMensaje = new formMensajeSistema;
                $nuevoMensaje -> formMensajeSistemaShow(
                    "Se actualizo con exito",
                    "<form action='getServicios.php' class='form-message__link' method='post' style='padding:0;'>
                    <input name='btnAgendarServicio'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                    </form>", true);
                }
        }
    }
}

?>