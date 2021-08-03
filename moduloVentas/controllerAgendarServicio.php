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
}

?>