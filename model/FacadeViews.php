<?php 
include_once("FactoryViews.php");
class FacadeViews {
    
    public function getFormAutenticarUsuario(){
        return FactoryViews::getView("AutenticarUsuario");
    }

    


}


?>