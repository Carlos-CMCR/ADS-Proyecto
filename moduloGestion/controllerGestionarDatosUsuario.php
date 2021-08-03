<?php 

class controllerGestionarDatosUsuario{ 
    public function obtenerGestionarDatosUsuarios(){
        include_once("formGestionarDatosUsuario.php");
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
        $objGestionarDatos= new formGestionarDatosUsuario($_SESSION["informacion"]);
        $objGestionarDatos -> formGestionarDatosUsuarioShow();
    }
}

?>